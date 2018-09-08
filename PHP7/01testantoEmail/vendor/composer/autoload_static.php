<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit63f2bad6ced23c8458ba1fcd7c46272a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit63f2bad6ced23c8458ba1fcd7c46272a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit63f2bad6ced23c8458ba1fcd7c46272a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
