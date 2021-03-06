<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit92c4ba52e36669fe6b8bc71a52e03800
{
    public static $files = array (
        '4a0c320d6028bda9e0eb3d2599dd9d0c' => __DIR__ . '/../..' . '/system/functions.php',
        '42907608ef1b52a912038dca93becf98' => __DIR__ . '/../..' . '/core/config/databases.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'system\\' => 7,
        ),
        'c' => 
        array (
            'core\\' => 5,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'system\\' => 
        array (
            0 => __DIR__ . '/../..' . '/system',
        ),
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit92c4ba52e36669fe6b8bc71a52e03800::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit92c4ba52e36669fe6b8bc71a52e03800::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
