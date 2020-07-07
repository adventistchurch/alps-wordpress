<?php
if(!defined( 'ABSPATH' )) exit;

const VENDOR = 'App';

/**
 * Init PSR-4 autoloading
 * Class naming pattern: App\{ClassName}
 *                       App\{Folder}\{ClassName}
 *                       App\{Folder}\{SubFolder}\{ClassName}
 *
 * @param string $class  Class name for auto loading
 */
function alps_autoload(string $class)
{
    $parts = explode('\\', $class);
    if (count($parts) < 2) {
        return;
    }

    $vendor = array_shift($parts);
    $path   = implode('/', $parts);

    if (VENDOR !== $vendor) {
        return;
    }

    $dir = __DIR__;
    $file = $dir . '/' . $path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('alps_autoload');
