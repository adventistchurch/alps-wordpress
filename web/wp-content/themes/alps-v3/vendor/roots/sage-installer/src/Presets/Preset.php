<?php

namespace Roots\Sage\Installer\Presets;

use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Preset
 *
 * Portions of this code were adopted from or inspired by Laravel
 *
 * Laravel is licensed under MIT and copyright Taylor Otwell
 * @see https://github.com/laravel/framework/blob/master/LICENSE.md
 * @license MIT
 */
abstract class Preset
{
    /** @var string */
    public $name;

    /** @var string */
    public $slug;

    /** @var object */
    public $package;

    /** @var bool */
    public $addOn;

    /** @var string */
    protected $sageRoot;

    /** @var string */
    protected $stubDirectory;

    /**
     * Default Preset constructor
     *
     * @param string $sageRoot The root folder for your Sage theme
     * @return static
     */
    public function __construct($sageRoot = '')
    {
        $this->sageRoot = $sageRoot ?: getcwd();
        $this->name = $this->name ?: str_replace(__NAMESPACE__.'\\', '', get_class($this));
        $this->stubDirectory = __DIR__."/stubs/{$this->name}";
        $this->slug = Str::slug($this->name, '');
    }

    /**
     * List of files that will be overwritten
     *
     * @return array
     */
    public function filesToOverwrite()
    {
        $files = new Filesystem;
        $stubs = array_map(function (SplFileInfo $file) {
            return $file->getRelativePathname();
        }, $files->allFiles("{$this->sageRoot}/resources/assets"));
        return array_intersect($stubs, $this->getFileList());
    }

    /**
     * List of files to be copied
     *
     * @return array
     */
    public function getFileList()
    {
        $files = new Filesystem;
        return array_map(function (SplFileInfo $file) {
            return $file->getRelativePathname();
        }, $files->allFiles($this->stubDirectory));
    }

    /**
     * Preset handler
     *
     * Call this method to run the preset
     *
     * @return void
     */
    public function handle()
    {
        $this->makeDirectories();
        if (!$this->addOn) {
            $this->removePresets();
        }
        $this->copyFiles();
        $this->updatePackages();
        $this->removeNodeModules();
    }

    /**
     * Update array of package.json
     *
     * @param array $packages Array representation of package.json
     *
     * @return array The updated $packages
     */
    abstract protected function updatePackagesArray(array $packages);

    /**
     * Update array of package.json
     *
     * @param array $packages Array representation of package.json
     *
     * @return array The updated $packages
     */
    protected function removePresetsFromPackagesArray(array $packages)
    {
        unset(
            $packages['dependencies']['bootstrap'],
            $packages['dependencies']['popper.js'],
            $packages['dependencies']['bulma'],
            $packages['dependencies']['tachyons-sass'],
            $packages['dependencies']['foundation-sites']
        );
        return $packages;
    }

    protected function makeDirectories()
    {
        $files = new Filesystem;
        $directories = [
            "{$this->sageRoot}/resources/assets/styles",
            "{$this->sageRoot}/resources/assets/styles/autoload",
            "{$this->sageRoot}/resources/assets/styles/common",
            "{$this->sageRoot}/resources/assets/styles/components",
            "{$this->sageRoot}/resources/assets/styles/layouts",
            "{$this->sageRoot}/resources/assets/scripts",
            "{$this->sageRoot}/resources/assets/scripts/autoload"
        ];
        $directories = array_diff($directories, array_filter($directories, [$files, 'isDirectory']));
        array_map([$files, 'makeDirectory'], $directories);
    }


    /**
     * Remove presets
     *
     * Removes previously loaded presets from the autoload folder
     *
     * @return void
     */
    protected function removePresets()
    {
        $files = new Filesystem;
        $files->delete("{$this->sageRoot}/resources/assets/styles/autoload/_tachyons.scss");
        $files->delete("{$this->sageRoot}/resources/assets/styles/autoload/_bootstrap.scss");
        $files->delete("{$this->sageRoot}/resources/assets/styles/autoload/_bulma.scss");
        $files->delete("{$this->sageRoot}/resources/assets/styles/autoload/_foundation.scss");
        $files->delete("{$this->sageRoot}/resources/assets/scripts/autoload/_bootstrap.js");
        $files->delete("{$this->sageRoot}/resources/assets/scripts/autoload/_foundation.js");
    }

    /**
     * Copy files from stubs directory to theme
     *
     * @return void
     */
    protected function copyFiles()
    {
        $files = new Filesystem;
        array_map(function ($file) use ($files) {
            $files->copy("{$this->stubDirectory}/{$file}", "{$this->sageRoot}/resources/assets/{$file}");
        }, $this->getFileList());
    }

    /**
     * Update package.json
     *
     * @param string $packagesFile Location of package.json
     * @return void
     */
    protected function updatePackages($packagesFile = '')
    {
        $packagesFile = $packagesFile ?: "{$this->sageRoot}/package.json";
        $packages = json_decode(file_get_contents($packagesFile), true);
        if (!$this->addOn) {
            $packages = $this->removePresetsFromPackagesArray($packages);
        }
        $packages = $this->updatePackagesArray($packages);
        ksort($packages['devDependencies']);
        ksort($packages['dependencies']);
        file_put_contents(
            $packagesFile,
            preg_replace_callback('/^ +/m', function ($matches) {
                return str_repeat(' ', strlen($matches[0]) / 2);
            }, json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL)
        );
    }

    /**
     * Deletes node_modules, yarn.lock, and package-lock.json
     *
     * @return void
     */
    protected function removeNodeModules()
    {
        $files = new Filesystem;

        $files->deleteDirectory("{$this->sageRoot}/node_modules");
        $files->delete("{$this->sageRoot}/yarn.lock");
        $files->delete("{$this->sageRoot}/package-lock.json");
    }

    public function __toString()
    {
        return $this->name;
    }
}
