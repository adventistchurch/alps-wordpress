<?php

namespace Roots\Sage\Installer;

use Roots\Sage\Installer\Console\Commands\MetaCommand;
use Roots\Sage\Installer\Console\Commands\PresetCommand;
use Roots\Sage\Installer\Console\Commands\ConfigCommand;

class Installer
{
    /** @var Application */
    public $app;

    public function __construct()
    {
        $app = new Application;
        $app->add(new MetaCommand);
        $app->add(new PresetCommand);
        $app->add(new ConfigCommand);
        $this->app = $app;
    }
}
