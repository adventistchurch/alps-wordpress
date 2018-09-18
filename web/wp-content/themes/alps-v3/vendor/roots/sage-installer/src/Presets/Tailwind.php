<?php

namespace Roots\Sage\Installer\Presets;

class Tailwind extends Preset
{
    /** {@inheritdoc} */
    protected function updatePackagesArray(array $packages)
    {
        $packages['devDependencies']['tailwindcss'] = '^0.6.5';

        /** Add Tailwind specific at-rules */
        $ignoreAtRules =& $packages['stylelint']['rules']['at-rule-no-unknown'][1]['ignoreAtRules'];
        $tailwindAtRules = ['tailwind', 'apply', 'responsive', 'variants', 'screen'];

        foreach ($tailwindAtRules as $rule) {
            if (!in_array($rule, $ignoreAtRules)) {
                $ignoreAtRules[] = $rule;
            }
        }

        return $packages;
    }
}
