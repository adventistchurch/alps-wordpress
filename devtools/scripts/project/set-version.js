const fs = require('fs').promises;
const util = require('util');
const exec = util.promisify(require('child_process').exec);
const chalk = require('chalk');

const getChangelog = require('../../lib/get-changelog');

/**
 * Update the version in package.json and package-lock.json
 *
 * @param {string} version Semver version value
 */
const setVersionInPackageJson = async (version) => {
    const packageContent = await fs.readFile('package.json', { encoding: 'utf-8' });
    const pkg = JSON.parse(packageContent);
    pkg.version = version;

    await fs.writeFile('package.json', JSON.stringify(pkg, null, 2));

    const packageLockContent = await fs.readFile('package-lock.json', { encoding: 'utf-8' });
    const pkgLock = JSON.parse(packageLockContent);
    pkgLock.version = version;

    await fs.writeFile('package-lock.json', JSON.stringify(pkgLock, null, 2));
};

/**
 * Update the version in composer.json
 *
 * @param {string} version Semver version value
 */
const setVersionInComposerJson = async (version) => {
    const composerContent = await fs.readFile('composer.json', { encoding: 'utf-8' });
    const composer = JSON.parse(composerContent);
    composer.version = version;

    await fs.writeFile('composer.json', JSON.stringify(composer, null, 2));
};

const isWorkdirClean = async () => {
    const { stdout, stderr } = await exec('git status --porcelain');
    if (stderr !== '') {
        throw new Error(`Git Status not working: ${stderr}`);
    }

    return stdout === '';
};

const createReleaseCommit = async (version) => {
    try {
        await exec(`git add .`);
        await exec(`git commit -m "release: v${version.version}"`);
        await exec(`git tag v${version.version}`);
    } catch (error) {
        if (error.stderr.match(/tag .* already exists/um)) {
            throw new Error('Version tag is already exists. Please delete it or increase the version number.');
        }

        console.log(error);
    }
};

const setVersion = async (opts) => {
    const { logger } = opts;
1
    console.log("WWWW: ");

    if (!await isWorkdirClean()) {
        logger.error(chalk.bold('❗ Commit all changes before release'));

        return;
    }

    // Get current version
    const changelog = await getChangelog();
    if (changelog.length === 0) {
        throw new Error(`Changelog has no entries`);
    }
    const currentVersion = changelog[0];
    logger.info(`🟡 Current version: ${chalk.bold(chalk.green(currentVersion.version))}\n`);

    // Update package.json
    await setVersionInPackageJson(currentVersion.version);
    logger.info(`💚 ${chalk.yellow('package.json')} updated`);

    // Update composer.json
    await setVersionInComposerJson(currentVersion.version);
    logger.info(`💚 ${chalk.yellow('composer.json')} updated`);

    // Create commit and tag
    await createReleaseCommit(currentVersion);

    logger.info(chalk.bold('\n❗ Now push changes to GitHub and new Release will be created'));
}

module.exports = setVersion;
