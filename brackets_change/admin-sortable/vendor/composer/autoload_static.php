<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit400308fe14459c16422f42ec1a9e62fa
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Brackets\\Sortable\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Brackets\\Sortable\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit400308fe14459c16422f42ec1a9e62fa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit400308fe14459c16422f42ec1a9e62fa::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
