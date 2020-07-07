<?php
if(!defined( 'ABSPATH' )) exit;

const VENDOR = 'App';

/**
 * Init PSR-4 autoloading for hope.* plugins
 * Class naming pattern: ACL\{ClassName}
 *                       ACL\{Folder}\{ClassName}
 *                       ACL\{Folder}\{SubFolder}\{ClassName}
 *
 * @param string $class  Class name for auto loading
 */
function acl_autoload(string $class)
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
spl_autoload_register('acl_autoload');
