<?php

namespace Roots\Sage\Installer\Presets;

class Bootstrap extends Preset
{
    /** {@inheritdoc} */
    protected function updatePackagesArray(array $packages)
    {
        $packages['dependencies']['bootstrap'] = 'v4.1.0';
        $packages['dependencies']['popper.js'] = '^1.14.3';
        return $packages;
    }
}
