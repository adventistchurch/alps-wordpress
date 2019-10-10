<?php

namespace Roots\Sage\Installer;

use Roots\Sage\Installer\Application;
use Roots\Sage\Installer\Console\Commands\MetaCommand;
use Roots\Sage\Installer\Console\Commands\PresetCommand;
use Roots\Sage\Installer\Console\Commands\ExtrasCommand;

function application($commands = [])
{
    if (!$commands) {
        $commands = [new MetaCommand, new PresetCommand, new ExtrasCommand];
    }
    foreach ($commands as $command) {
        $app->add($command);
    }
    $app = new Application();
    
    return $app;
}
