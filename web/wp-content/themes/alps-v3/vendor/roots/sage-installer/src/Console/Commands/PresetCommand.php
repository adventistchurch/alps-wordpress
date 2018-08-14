<?php

namespace Roots\Sage\Installer\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use Roots\Sage\Installer\Presets\Bootstrap;
use Roots\Sage\Installer\Presets\Bulma;
use Roots\Sage\Installer\Presets\Foundation;
use Roots\Sage\Installer\Presets\None;
use Roots\Sage\Installer\Presets\Preset;
use Roots\Sage\Installer\Presets\Tachyons;
use Roots\Sage\Installer\Transformations\Presets;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PresetCommand extends Command
{
    /** {@inheritdoc} */
    protected $description = 'Swap the front-end scaffolding for the theme';

    /** @var Presets */
    public $presets;

    /** {@inheritdoc} */
    public function __construct($presets = null)
    {
        $this->presets = new Presets($presets ?: $this->defaultPresets());
        $slugs = implode(', ', $this->presets->slugs());
        $this->signature = "preset { framework : The front-end framework ({$slugs}) }";
        parent::__construct();
    }

    protected function configure()
    {
        parent::configure();
        $this->addOption(
            'overwrite',
            'Y',
            InputOption::VALUE_NONE,
            'Confirm overwriting files',
            null
        );
    }

    /** {@inheritdoc} */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $this->framework();
    }

    /** {@inheritdoc} */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!in_array($this->argument('framework'), $this->presets->slugs())) {
            throw new InvalidArgumentException('Invalid preset.');
        }

        $preset = $this->presets[$this->argument('framework')];
        if (!$this->confirmOverwrite($preset->filesToOverwrite())) {
            $this->info('No actions were taken.');
            return;
        }
        $preset->handle();
        $this->info('Done.');
        $this->comment('Please run `yarn && yarn build` to compile your fresh scaffolding.');
        $this->comment('');
        $this->comment('Help support our open-source development efforts by contributing to Sage on OpenCollective:');
        $this->comment('https://opencollective.com/sage');
        $this->comment('Join us on the Roots Community Slack when you become a supporter!');
    }

    protected function framework()
    {
        if ($this->argument('framework')) {
            return;
        }
        $default = array_search('bootstrap', $this->presets->slugs());
        $framework = $this->choice('Which framework would you like to load?', $this->presets->names(), $default);
        $framework = array_search($framework, $this->presets->names());
        $this->input->setArgument('framework', $this->presets->slugs()[$framework]);
    }

    /**
     * Confirm overwriting files
     *
     * @return bool
     */
    protected function confirmOverwrite(array $files = [])
    {
        if (!$files || $this->option('overwrite')) {
            return true;
        }
        $files = implode("\n - ", $files);
        return $this->confirm(
            "Are you sure you want to overwrite the following files?\n<comment> - {$files}</comment>\n\n"
        );
    }

    /** @return Preset[] */
    protected function defaultPresets()
    {
        return [
            new None($this->root),
            new Bootstrap($this->root),
            new Bulma($this->root),
            new Foundation($this->root),
            new Tachyons($this->root)
        ];
    }
}
