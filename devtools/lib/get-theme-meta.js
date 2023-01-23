const fs = require('fs').promises;

const getPluginMeta = async () => {
    const pkg = JSON.parse(await fs.readFile('plugin.json', { encoding: 'utf-8' }));

    return pkg;
};

module.exports = getPluginMeta;
