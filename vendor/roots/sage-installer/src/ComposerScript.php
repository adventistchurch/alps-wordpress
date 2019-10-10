<?php

namespace Roots\Sage\Installer;

use Composer\Script\Event;
use Roots\Sage\Installer\Console\Exceptions\ConfigureCommandException;
use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class ComposerScript
{
    /** @var Event */
    public $event;

    public function __construct(Event $event = null)
    {
        $this->event = $event;
    }

    public static function postCreateProject(Event $event)
    {
        $sage = escapeshellarg(dirname(__DIR__).'/bin/sage');
        (new static($event))
            ->validate()
            ->run(new Process(sprintf('php %s %s', $sage, 'meta')))
            ->run(new Process(sprintf('php %s %s', $sage, 'config')))
            ->run(new Process(sprintf('php %s %s', $sage, 'preset')));
    }

    public function validate()
    {
        if (!$this->isWordPressTheme()) {
            throw new ConfigureCommandException('Composer hooks must be called from your theme root.');
        }

        if (!$this->isInteractive()) {
            $this->write('Interactive mode disabled. Skipping parts of post-create-project routine.');
        }

        if (PHP_OS === 'WINNT') {
            $this->write([
                '<warning>TTY mode is not supported on Windows platform.</warning>',
                '',
                'Some interactive parts of post-create-project routine might be skipped.',
                '',
                'Running the <comment>sage</comment> cli tool manually should still work.',
                '',
                '<comment>https://roots.io/sage/docs/</comment>'
            ]);
        }
        return $this;
    }

    protected function isInteractive()
    {
        return $this->event->getIO()->isInteractive();
    }

    protected function isWordPressTheme()
    {
        return $this->event->getComposer()->getPackage()->getType() === 'wordpress-theme'
            && file_exists(getcwd().'/resources/style.css');
    }

    protected function write($message)
    {
        $this->event->getIO()
            ->write($message);
    }

    public function run(Process $process)
    {
        try {
            $process->setTty($this->isInteractive());
        } catch (RuntimeException $e) {
            // do nothing.
        }

        $process->run();
        return $this;
    }
}
