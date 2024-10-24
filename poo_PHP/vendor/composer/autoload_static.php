<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit87a7b204d63469362a57535480d9265e
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/clases',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit87a7b204d63469362a57535480d9265e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit87a7b204d63469362a57535480d9265e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit87a7b204d63469362a57535480d9265e::$classMap;

        }, null, ClassLoader::class);
    }
}
