const fs = require('fs').promises;

const getPackageInfo = async () => {
    const pkg = JSON.parse(await fs.readFile('package.json', { encoding: 'utf-8' }));

    return {
        name: pkg.name,
        version: pkg.version,
    }
};

module.exports = getPackageInfo;
