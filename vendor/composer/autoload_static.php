<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf8b85e9c6d09eb11131153ca1b15c01f
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chillerlan\\Settings\\' => 20,
            'chillerlan\\QRCode\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chillerlan\\Settings\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-settings-container/src',
        ),
        'chillerlan\\QRCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-qrcode/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf8b85e9c6d09eb11131153ca1b15c01f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf8b85e9c6d09eb11131153ca1b15c01f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf8b85e9c6d09eb11131153ca1b15c01f::$classMap;

        }, null, ClassLoader::class);
    }
}
