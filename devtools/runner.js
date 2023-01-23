const fsLib = require('fs');
const yaml = require('yaml');
const logger = require('./lib/logger.js');
const themeBuild = require('./scripts/theme/build.js');
const setVersion = require('./scripts/project/set-version');

const fs = fsLib.promises;

const scripts = {
    'project:set-version': setVersion,
    'theme:build': themeBuild,
    // 'plugin:release': require('./scripts/plugin/release'),
    // 'i18n:create-json': require('./scripts/i18n/create-json'),
};

(async () => {
    let env = { ...process.env };

    if (process.env.NODE_ENV === 'development') {
        try {
            const envYaml = await fs.readFile('.env.yml', { encoding: 'utf-8' });
            const localEnv = yaml.parse(envYaml);
            env = {
                ...env,
                ...localEnv,
            };
        } catch (err) {}
    }

    const scriptName = process.argv[2];
    const runFlag = process.argv[3];

    if (typeof scripts[scriptName] !== 'function') {
        throw new Error(`DevTools script "${scriptName}" is not found.`);
    }

    await scripts[scriptName]({
        logger,
        env,
        projectRoot: process.cwd(),
        args: {
            dev: runFlag === '--dev',
        },
    });

})().then(() => {
    process.exit(0);
}).catch((err) => {
    logger.error(`\n❌ ${err}`);
    process.exit(1);
});
