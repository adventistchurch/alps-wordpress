const fs = require('fs').promises;
const chalk = require('chalk');
const gettext = require('gettext-parser');
const getPackageInfo = require('../../lib/get-package-info');

const i18nCreateJson = async (opts) => {
    const { logger, projectRoot } = opts;

    const pkg = await getPackageInfo();

    const wpScriptHandler = 'alps-gb';
    const langRoot = `${projectRoot}/languages`;
    const poFilePattern = new RegExp(`^${pkg.name}-(?<lang>[a-z]{2}_[A-Z]{2})\.po$`, 'u');

    logger.info(`📖 Reading the ${chalk.green('*.po')} language files from ${chalk.green(langRoot)}`);
    const langFiles = await fs.readdir(langRoot);

    if (langFiles.length === 0) {
        logger.warn(`Language files not found. Check the naming of po to b`)
    }

    for (const poFileName of langFiles) {
        const match = poFileName.match(poFilePattern);
        if (!match) {
            continue;
        }

        logger.info(`🌵 ${chalk.yellow(match.groups.lang)} lang found in ${chalk.green(poFileName)}`);
        const poContentRaw = await fs.readFile(`${langRoot}/${poFileName}`);
        const poContent = gettext.po.parse(poContentRaw);

        const jsonMessages = {
            '': {
                domain: 'messages',
                lang: poContent.headers.Language,
                'plural-forms': poContent.headers['Plural-Forms'],
            },
        };
        for (const msg of Object.values(poContent.translations[''])) {
            if (msg.msgid === '') {
                continue;
            }
            jsonMessages[msg.msgid] = msg.msgstr;
        }

        const jsonFileName = `${pkg.name}-${match.groups.lang}-${wpScriptHandler}.json`;
        const jsonContent = {
            locale_data: {
                messages: jsonMessages,
            },
        };

        await fs.writeFile(`${langRoot}/${jsonFileName}`, JSON.stringify(jsonContent));
        logger.info(`✏️ ${chalk.yellow(match.groups.lang)} converted to JSON format and saved to ${chalk.green(jsonFileName)}`);
    }
};

module.exports = i18nCreateJson;
