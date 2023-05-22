<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitde100123ec7f6040647a84ac969f4076
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitde100123ec7f6040647a84ac969f4076', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitde100123ec7f6040647a84ac969f4076', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitde100123ec7f6040647a84ac969f4076::getInitializer($loader));

        $loader->register(true);

        $filesToLoad = \Composer\Autoload\ComposerStaticInitde100123ec7f6040647a84ac969f4076::$files;
// <<<<<<< HEAD
//         $requireFile = \Closure::bind(static function ($fileIdentifier, $file) {
// =======
        $requireFile = static function ($fileIdentifier, $file) {
// >>>>>>> origin/master
            if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
                $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

                require $file;
            }
// <<<<<<< HEAD
//         }, null, null);
//         foreach ($filesToLoad as $fileIdentifier => $file) {
//             $requireFile($fileIdentifier, $file);
// =======
        };
        foreach ($filesToLoad as $fileIdentifier => $file) {
            ($requireFile)($fileIdentifier, $file);
// >>>>>>> origin/master
        }

        return $loader;
    }
}
