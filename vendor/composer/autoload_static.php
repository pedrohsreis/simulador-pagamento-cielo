<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit473ada41921d15ffb893831030011aa6
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Cielo' => 
            array (
                0 => __DIR__ . '/..' . '/developercielo/api-3.0-php/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit473ada41921d15ffb893831030011aa6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit473ada41921d15ffb893831030011aa6::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit473ada41921d15ffb893831030011aa6::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
