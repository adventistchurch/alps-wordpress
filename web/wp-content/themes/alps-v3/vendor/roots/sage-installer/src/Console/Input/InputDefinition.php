<?php

namespace Roots\Sage\Installer\Console\Input;

use Symfony\Component\Console\Input\InputDefinition as InputDefinitionBase;
use Symfony\Component\Console\Input\InputOption;

/**
 * Allow use of unknown command line options
 */
class InputDefinition extends InputDefinitionBase
{
    public function getOption($name)
    {
        if (!parent::hasOption($name)) {
            $this->addOption(new InputOption($name, null, InputOption::VALUE_OPTIONAL));
        }
        return parent::getOption($name);
    }

    public function hasOption($name)
    {
        return true;
    }
}
