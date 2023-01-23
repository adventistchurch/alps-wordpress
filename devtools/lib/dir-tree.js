const fs = require('fs').promises;

const dirTree = async (path, { whiteList = [], rootPath = ''} = {}) => {
    const tree = [];
    const files = await fs.readdir(path);

    for (const file of files) {
        const filePath = `${path}/${file}`;
        const fileStat = await fs.stat(filePath);

        if (fileStat.isDirectory()) {
            tree.push(...await dirTree(filePath, {
                whiteList,
                rootPath: rootPath ? rootPath : path,
            }));
        } else {
            const replacePath = rootPath ? rootPath : path;
            tree.push(filePath.replace(`${replacePath}/`, '/'));
        }
    }

    if (rootPath) {
        return tree;
    }

    return tree.filter((item) => {
        for (const pattern of whiteList) {
            if (item.match(pattern)) {
                return true;
            }
        }

        return false;
    })
};

module.exports = dirTree;
