<?php

namespace Roots\Sage\Installer\Console\Commands;

use Roots\Sage\Installer\Console\Exceptions\ConfigureCommandException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigCommand extends Command
{
    /** {@inheritdoc} */
    protected $description = 'Configure development environment';

    /** @var array */
    protected $config;

    /** @var string */
    protected $configFile;

    /** {@inheritdoc} */
    protected function configure()
    {
        parent::configure();
        $this->configFile = "{$this->root}/resources/assets/config.json";
        $this->config = json_decode(file_get_contents($this->configFile), true);
        $this->addOption(
            'url',
            null,
            InputOption::VALUE_REQUIRED,
            "Local development URL of WP site <comment>[default: \"{$this->config['devUrl']}\"]</comment>",
            null
        );
        $this->addOption(
            'path',
            null,
            InputOption::VALUE_REQUIRED,
            'Path to theme directory (e.g., /wp-content/themes/'.basename($this->root).') '
                ."<comment>[default: \"{$this->config['publicPath']}\"]</comment>",
            null
        );
    }

    /** {@inheritdoc} */
    protected function validate()
    {
        if (!file_exists($config = "{$this->root}/resources/assets/config.json")) {
            throw new ConfigureCommandException("FILE NOT FOUND:\n    {$config}");
        }
    }

    /** {@inheritdoc} */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $url = $this->option('url')
            ?: $this->ask('Local development URL of WP site', $this->config['devUrl']);

        $path = $this->option('path')
            ?: $this->ask(
                'Path to theme directory (e.g., /wp-content/themes/'.basename($this->root).')',
                $this->config['publicPath']
            );

        $this->config['devUrl'] = rtrim($url, '/');
        $this->config['publicPath'] = rtrim($path, '/');
    }

    /** {@inheritdoc} */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        file_put_contents(
            $this->configFile,
            preg_replace_callback('/^ +/m', function ($matches) {
                return str_repeat(' ', strlen($matches[0]) / 2);
            }, json_encode($this->config, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL)
        );
    }
}
