const fs = require('fs-extra');
const archiver = require('archiver');
const chalk = require('chalk');
const { DateTime } = require('luxon');
const exec = require('../../lib/exec');
const dirTree = require('../../lib/dir-tree');
const getPackageInfo = require('../../lib/get-package-info');
const getThemeMeta = require('../../lib/get-theme-meta');

const themeBuild = async (opts) => {
  const { logger, args } = opts;

  const pkg = await getPackageInfo();

  const buildDir = `build/`;
  const pluginDir = `${buildDir}${pkg.name}/`;
  await fs.emptyDir(buildDir);
  await fs.emptyDir(pluginDir);

  if (args.dev) {
    logger.info('🎯 Build theme in dev mode');
  } else {
    logger.info('🎯 Build ALPS Theme');
  }

  await exec('composer install', logger);

  logger.info(`💼 Copy plugin files to ${chalk.yellow(pluginDir)}`);

  const whiteList = [
    /^\/app\/.+\.php$/u,
    /^\/app\/carbon-fields\/.+\.js$/u,
    /^\/app\/carbon-fields\/.+\.css$/u,
    /^\/app\/local\/.+\.md$/u,
    /^\/public\/.+$/u,
    /^\/[^\/]+\.php$/u,
    /^\/[^\/]+\.json$/u,
    /^\/[^\/]+\.js$/u,
    /^\/[^\/]+\.md$/u,
    /^\/[^\/]+\.png$/u,
    /^\/[^\/]+\.css$/u,
    /^\/[^\/]+\.lock$/u,
    /^\.editorconfig$/u,
    /^\/dist/u,
    /^\/vendor/u,
    /^\/resources/u,
  ];
  const pluginFiles = await dirTree('.', {
    whiteList,
  });

  for (const pf of pluginFiles) {
    await fs.copy(`./${pf}`, `${pluginDir}${pf}`);
  }

  // Package plugin
  if (!args.dev) {
    await createArchive(buildDir, pkg.name);
    logger.info(`💚 ALPS Theme packaged to ${chalk.yellow(`${pkg.name}.zip`)}`);
  }

  // Gather metadata
  if (!args.dev) {
      const themeMeta = {
          ...await getThemeMeta(),
          version: pkg.version,
          last_updated: DateTime.utc().toFormat('yyyy-LL-dd HH:mm:ss ZZZZ'),
      };
      themeMeta.download_url = themeMeta.download_url
          .replace('{file}', `${pkg.name}-v${pkg.version}.zip`);

      await fs.writeFile(`${buildDir}alps.json`, JSON.stringify(themeMeta, null, 2));
      logger.info(`💚 ALPS Theme metadata saved to ${chalk.yellow(`alps.json`)}`);
  }
}

const createArchive = (src, name, logger) => {
    return new Promise((resolve, reject) => {
        const archiveOutput = fs.createWriteStream(`${src}${name}.zip`);
        const archive = archiver('zip', {
            zlib: { level: 9 },
        });

        archiveOutput.on('close', () => {
            resolve({
                size: archive.pointer(),
            });
        });

        archive.on('warning', (err) => {
            if (err.code === 'ENOENT') {
                logger.warn(err.message);
            } else {
                reject(err);
            }
        });

        archive.on('error', (err) => {
            reject(err);
        });

        archive.pipe(archiveOutput);
        archive.directory(`${src}${name}`, name);
        archive.finalize();
    });
};

module.exports = themeBuild;
