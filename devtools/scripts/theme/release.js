const fs = require('fs');
const chalk = require('chalk');
const { Octokit } = require("@octokit/rest");
const getChangelog = require('../../lib/get-changelog');
const getPackageInfo = require('../../lib/get-package-info');
const FormData = require('form-data');
const got = require("got");
// const {THEME_PACKAGE_NAME} = require("../../dev-tools-constants");
require('dotenv').config()

const R2_BUCKET_NAME = 'alps';

const pluginRelease = async (opts) => {
    let env = process.env ;
    const { logger } = opts;

    const githubToken = env.GITHUB_TOKEN || null;
    const [githubOwner, githubRepo] = env.GITHUB_REPOSITORY.split('/');
    const githubRef = env.GITHUB_REF || null;

    const pkg = await getPackageInfo();

    const buildDir = 'build/';
    const localFileName = `${pkg.name}.zip`;
    const distFileName = `alps-wordpress-v${pkg.version}.zip`;
    const metadataFileName = `alps-wordpress-v3.json`;

    // Extract git tag
    const match = githubRef.match(/^refs\/tags\/(?<tag>v\d+\.\d+\.\d+\.\d+)$/);
    if (!match) {
        throw new Error(`Invalid tag name for release: "${githubRef.replace('refs/tags/', '')}"`);
    }
    const tag = match.groups.tag;

    // Compose release description
    const changelog = await getChangelog();
    const currentVersion = changelog[0];
    const releaseDesc = [currentVersion.desc];
    for (const changeType of currentVersion.types) {
        releaseDesc.push(`## ${changeType.title}`);
        for (const changeTypeEntry of changeType.entries) {
            releaseDesc.push(`- ${changeTypeEntry}`);
        }
    }
    console.log("Check Tag: " + tag);

    // Create Release on GitHub
    const octokit = new Octokit({
        auth: githubToken,
    });

    try {
        const existingRelease = await octokit.repos.getReleaseByTag({
            owner: githubOwner,
            repo: githubRepo,
            tag,
        });
        await octokit.repos.deleteRelease({
            owner: githubOwner,
            repo: githubRepo,
            release_id: existingRelease.data.id,
        });
    } catch (e) {}

    const createReleaseResponse = await octokit.repos.createRelease({
        owner: githubOwner,
        repo: githubRepo,
        tag_name: tag,
        name: tag,
        body: releaseDesc.join("\n"),
    });

    console.log("Checks before release!")

    await octokit.repos.uploadReleaseAsset({
        url: createReleaseResponse.data.upload_url,
        name: distFileName,
        data: await fs.promises.readFile(`${buildDir}${localFileName}`),
    });
    logger.info(`🍀 Release ${chalk.green(tag)} published on GitHub`);

    const formDataZip = new FormData();
    formDataZip.append('bucket', R2_BUCKET_NAME);
    formDataZip.append('path', `/wordpress/themes/alps/alps-wordpress-v${pkg.version}.zip`);
    formDataZip.append('data', fs.createReadStream(`${buildDir}${localFileName}`));

    await got('https://alps-r2.adventist.workers.dev/upload', {
        method: 'POST',
        body: formDataZip,
        headers: {
          'Authorization': `Bearer ${env.CLOUDFLARE_R2_ACCESS_TOKEN}`
        }
    })
    logger.info(`🔼 ${chalk.yellow(distFileName)} pushed to R2.`);

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
};

module.exports = pluginRelease;
