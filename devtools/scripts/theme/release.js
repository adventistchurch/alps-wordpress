const fs = require('fs').promises;
const SFTPClient = require('ssh2-sftp-client');
const chalk = require('chalk');
const { Octokit } = require("@octokit/rest");
const getChangelog = require('../../lib/get-changelog');
const getPackageInfo = require('../../lib/get-package-info');

const pluginRelease = async (opts) => {
    const { logger, env } = opts;

    const githubToken = env.GITHUB_TOKEN || null;
    const [githubOwner, githubRepo] = env.GITHUB_REPOSITORY.split('/');
    const githubRef = env.GITHUB_REF || null;

    const cdnHost = env.CDN_HOST || null;
    const cdnUser = env.CDN_USER || null;
    const cdnPrivateKey = env.CDN_PRIVATE_KEY || null;
    const cdnPrivateKeyPass = env.CDN_PRIVATE_KEY_PASS || null;
    const cdnRootPath = env.CDN_ROOT_PATH || null;

    const pkg = await getPackageInfo();

    const buildDir = 'build/';
    const localFileName = `${pkg.name}.zip`;
    const distFileName = `${pkg.name}-v${pkg.version}.zip`;
    const metadataFileName = `${pkg.name}.json`;

    // Extract git tag
    const match = githubRef.match(/^refs\/tags\/(?<tag>v\d+\.\d+\.\d+)$/);
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

    await octokit.repos.uploadReleaseAsset({
        url: createReleaseResponse.data.upload_url,
        name: distFileName,
        data: await fs.readFile(`${buildDir}${localFileName}`),
    });
    logger.info(`🍀 Release ${chalk.green(tag)} published on GitHub`);

    // Upload to CDN
    const sftp = new SFTPClient();
    logger.info(`➡️ Check creating sftp client! Client was created!`);
    await sftp.connect({
        host: cdnHost,
        username: cdnUser,
        privateKey: cdnPrivateKey,
        passphrase: cdnPrivateKeyPass,
        debug: console.log
    }).catch(e => logger.info(`Unable to connect -- ${e.message}`));

    await sftp.put(`${buildDir}${localFileName}`, `${cdnRootPath}/${distFileName}`);
    logger.info(`🔼 ${chalk.yellow(distFileName)} pushed to CDN`);

    await sftp.put(`${buildDir}${metadataFileName}`, `${cdnRootPath}/${metadataFileName}`);
    logger.info(`🔼 ${chalk.yellow(metadataFileName)} pushed to CDN`);
};

module.exports = pluginRelease;
