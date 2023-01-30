const fs = require('fs').promises;

const getThemeMeta = async () => {
    const pkg = JSON.parse(await fs.readFile('theme.json', { encoding: 'utf-8' }));

    return pkg;
};

module.exports = getThemeMeta;
