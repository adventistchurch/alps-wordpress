<?php

namespace Roots\Sage\Installer\Presets;

class Tachyons extends Preset
{
    /** {@inheritdoc} */
    protected function updatePackagesArray(array $packages)
    {
        $packages['dependencies']['tachyons-sass'] = '~4.9';
        return $packages;
    }
}
