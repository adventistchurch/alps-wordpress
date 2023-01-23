const util = require('util');
const sysExec = util.promisify(require('child_process').exec);
const chalk = require('chalk');

const exec = async (cmd, logger) => {
    logger.info(`🏃 Run command ${chalk.bold(chalk.yellow(cmd))}`);

    try {
        const { stdout } = await sysExec(cmd);
        logger.info(stdout);
        logger.info(`✅ ${chalk.bold('SUCCESS')}`);
    } catch (error) {
        throw new Error(error.stderr);
    }
};

module.exports = exec;
