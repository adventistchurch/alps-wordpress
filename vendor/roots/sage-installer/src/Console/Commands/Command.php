<?php

namespace Roots\Sage\Installer\Console\Commands;

use Illuminate\Console\Command as BaseCommand;
use Roots\Sage\Installer\Console\Exceptions\ConfigureCommandException;
use Roots\Sage\Installer\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends BaseCommand
{
    /** @var string The console command help message. */
    protected $help;

    /** @var \Throwable Catchable error thrown during construction. */
    protected $configError;

    /** @var string Path to theme root folder, e.g., /srv/www/example.test/current/web/app/themes/sage */
    protected $root;

    /** {@inheritdoc} */
    public function __construct()
    {
        $this->root = getenv('SAGE_ROOT') ?: getcwd();
        $this->name = $this->name ?: strtolower(str_replace([__NAMESPACE__.'\\', 'Command'], '', get_class($this)));
        $this->setHelp($this->help ?: $this->description);
        parent::__construct();
    }

    /** {@inheritdoc} */
    protected function configure()
    {
        $this->setDefinition(new InputDefinition);
        parent::configure();
    }

    /** {@inheritdoc} */
    public function run(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->validate();
        } catch (ConfigureCommandException $error) {
            $output->block(explode("\n", $error), null, 'error', '  ', true);
            die();
        }
        parent::run($input, $output);
    }

    /**
     * Ensure that command can safely run.
     *
     * @throws ConfigureCommandException if it is not safe to run the command.
     */
    protected function validate()
    {
    }

    /** {@inheritdoc} */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }

    /** {@inheritdoc} */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
    }

    /** {@inheritdoc} */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
    }
}
