<?php

namespace Roots\Sage\Installer\Transformations;

use Illuminate\Support\Collection;

class ThemeHeaders
{
    protected $content;

    public $stylesheet;

    public $headers = [
        'Name'        => 'Sage Starter Theme',
        'URI'         => 'https://roots.io/sage/',
        'Description' => 'Sage is a WordPress starter theme.',
        'Version'     => '9.0.1',
        'Author'      => 'Roots',
        'Author URI'  => 'https://roots.io/'
    ];

    public function __construct($stylesheet = '')
    {
        $this->headers = new Collection($this->headers);
        $this->stylesheet = $stylesheet ?: getcwd().'/resources/style.css';
    }

    public function getCurrentHeaders()
    {
        $this->content = file_get_contents($this->stylesheet);
        $this->headers->transform(function ($value, $field) {
            preg_match('/^.*'.preg_quote($field, '/').'[^:]*:(.*)$/mi', $this->content, $matches);
            return $matches && $matches[1] ? trim($matches[1]) : $value;
        });
        return $this;
    }

    public function replaceHeaders($headers)
    {
        $content = str_replace($this->headers->all(), $headers->all(), $this->content);
        file_put_contents($this->stylesheet, $content);
    }
}
