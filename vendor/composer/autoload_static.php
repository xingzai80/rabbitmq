<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit859526752e05c1c0d04d4d67f182af47
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpAmqpLib\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpAmqpLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-amqplib/php-amqplib/PhpAmqpLib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit859526752e05c1c0d04d4d67f182af47::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit859526752e05c1c0d04d4d67f182af47::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
