const FormData = require("form-data");
const fs = require("fs");
const got = require("got");
const chalk = require("chalk");
const { Octokit } = require("@octokit/rest");
const getPackageInfo = require("../../lib/get-package-info");
const core = require('@actions/core');
const getThemeMeta = require('../../lib/get-theme-meta');
const { DateTime } = require('luxon');
const {fi} = require("date-fns/locale");
require('dotenv').config()

const R2_BUCKET_NAME = 'alps';

const manualRelease = async (opts) => {
  let env = process.env ;
  const { logger } = opts;

  const pkg = await getPackageInfo();
  const githubToken = env.GITHUB_TOKEN || null;
  const [githubOwner, githubRepo] = env.GITHUB_REPOSITORY.split('/');

  const octokit = new Octokit({
    auth: githubToken,
  });

  // Extract git tag
  // Get the value of an input
  const tag = process.env.RELEASE_ID;
  const match = tag.match(/v\d+\.\d+\.\d+\.\d+$/);
  if (!match) {
    throw new Error(`Invalid tag name for release: "${tag}"`);
  }

  const localStylesDir = 'app/local/alps/';
  const mainCssName = 'main.css';
  const headScriptMin = 'head-script.min.js';
  const scriptMin = 'script.min.js';

  const buildDir = 'build/';
  const localFileName = `${pkg.name}.zip`;
  const distFileName = `alps-wordpress-v${pkg.version}.zip`;
  const metadataFileName = `alps-wordpress-v3.json`;

  fs.mkdirSync("build");

  let downloadUrl = '';
  let existingRelease = '';
  try {
    existingRelease = await octokit.repos.getReleaseByTag({
      owner: githubOwner,
      repo: githubRepo,
      tag,
    });

    logger.info('Updating latest release...')

    // Update github release from draft to PROD
    try {
      await octokit.repos.updateRelease({
        owner: githubOwner,
        repo: githubRepo,
        release_id: existingRelease.data.id,
        draft: false,
        prerelease: false,
        make_latest: true
      });
    } catch (e) {}

    logger.info(`🍀 Release ${chalk.green(tag)} published on GitHub`);

    const assets = existingRelease.data.assets;
    console.log("Existing Release: " + JSON.stringify(existingRelease));
    if (assets.length > 0) {
      for (const asset of assets) {
        if (asset.name === distFileName) {
          downloadUrl = asset.browser_download_url;
        }
      }

      if (downloadUrl === '') {
        logger.info("❌ Download URL is empty! Assets in existingRelease: " + assets.length + ". Dist FileName: " + distFileName + ". Existing Release: " + JSON.stringify(existingRelease));
        return false;
      }

      const files = fs.readdirSync('build');
      for(const file of files) {
        console.log("FILE: " + JSON.stringify(file))
      }

    } else {
      console.log('Assets is empty! ' + tag);
      return false;
    }
  } catch (e) {}

  console.log("FOLDER IS exists: " + fs.existsSync('build'));

  const filePath = buildDir + distFileName;
  const fileStream = fs.createWriteStream(filePath);

  console.log("Downloading is started... " + downloadUrl);

  await new Promise((resolve, reject) => {
    fileStream
      .on('finish', resolve)
      .on('error', (error) => {
        console.error('Error downloading the file:', error);
        reject(error);
      });

    got.stream(downloadUrl).pipe(fileStream);
  });

  console.log(`The file was successfully downloaded and saved in: ${filePath}`);

  const formDataZip = new FormData();
  formDataZip.append('bucket', R2_BUCKET_NAME);
  formDataZip.append('path', `/wordpress/themes/alps/alps-wordpress-v${pkg.version}.zip`);
  formDataZip.append('data', fs.createReadStream(`${buildDir}${distFileName}`));

  await got('https://alps-r2.adventist.workers.dev/upload', {
    method: 'POST',
    body: formDataZip,
    headers: {
      'Authorization': `Bearer ${env.CLOUDFLARE_R2_ACCESS_TOKEN}`
    }
  })
  logger.info(`🔼 ${chalk.yellow(distFileName)} pushed to R2.`);

  // Gather metadata for JSON
  const themeMeta = {
    ...await getThemeMeta(),
    version: pkg.version,
    requires: '6.4.1',
    last_updated: DateTime.utc().toFormat('yyyy-LL-dd HH:mm:ss ZZZZ'),
  };
  themeMeta.download_url = themeMeta.download_url
    .replace('{file}', `alps-wordpress-v${pkg.version}.zip`);

  await fs.writeFileSync(`${buildDir}alps-wordpress-v3.json`, JSON.stringify(themeMeta, null, 2));
  logger.info(`💚 ALPS Theme metadata saved to ${chalk.yellow(`alps-wordpress-v3.json`)}`);

  // Upload JSON to R2
  const formDataJson = new FormData();
  formDataJson.append('bucket', R2_BUCKET_NAME);
  formDataJson.append('path', '/wordpress/themes/alps/' + metadataFileName);
  formDataJson.append('data', fs.createReadStream(`${buildDir}${metadataFileName}`));

  await got('https://alps-r2.adventist.workers.dev/upload', {
    method: 'POST',
    body: formDataJson,
    headers: {
      'Authorization': `Bearer ${env.CLOUDFLARE_R2_ACCESS_TOKEN}`
    }
  })
  logger.info(`🔼 ${chalk.yellow(metadataFileName)} pushed to R2.`);

  logger.info(`🔼 ${chalk.yellow(metadataFileName)} pushed to R2.`);

  const mainCssData = new FormData();
  mainCssData.append('bucket', R2_BUCKET_NAME);
  mainCssData.append('path', `/wordpress/themes/alps/${mainCssName}`);
  mainCssData.append('data', fs.createReadStream(`${localStylesDir}/css/${mainCssName}`));

  await got('https://alps-r2.adventist.workers.dev/upload', {
    method: 'POST',
    body: mainCssData,
    headers: {
      'Authorization': `Bearer ${env.CLOUDFLARE_R2_ACCESS_TOKEN}`
    }
  })
  logger.info(`🔼 ${chalk.yellow(mainCssName)} pushed to R2.`);

  const headScriptMinData = new FormData();
  headScriptMinData.append('bucket', R2_BUCKET_NAME);
  headScriptMinData.append('path', `/wordpress/themes/alps/${headScriptMin}`);
  headScriptMinData.append('data', fs.createReadStream(`${localStylesDir}/js/${headScriptMin}`));

  await got('https://alps-r2.adventist.workers.dev/upload', {
    method: 'POST',
    body: headScriptMinData,
    headers: {
      'Authorization': `Bearer ${env.CLOUDFLARE_R2_ACCESS_TOKEN}`
    }
  })
  logger.info(`🔼 ${chalk.yellow(headScriptMin)} pushed to R2.`);

  const scriptMinData = new FormData();
  scriptMinData.append('bucket', R2_BUCKET_NAME);
  scriptMinData.append('path', `/wordpress/themes/alps/${scriptMin}`);
  scriptMinData.append('data', fs.createReadStream(`${localStylesDir}/js/${scriptMin}`));

  await got('https://alps-r2.adventist.workers.dev/upload', {
    method: 'POST',
    body: scriptMinData,
    headers: {
      'Authorization': `Bearer ${env.CLOUDFLARE_R2_ACCESS_TOKEN}`
    }
  })
  logger.info(`🔼 ${chalk.yellow(scriptMin)} pushed to R2.`);
}

module.exports = manualRelease;
