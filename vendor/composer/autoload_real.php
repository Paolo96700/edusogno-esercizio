<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf922a3a8c904a9a1dbe1860cdb28c3db
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

        spl_autoload_register(array('ComposerAutoloaderInitf922a3a8c904a9a1dbe1860cdb28c3db', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf922a3a8c904a9a1dbe1860cdb28c3db', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitf922a3a8c904a9a1dbe1860cdb28c3db::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}