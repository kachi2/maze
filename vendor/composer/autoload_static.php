<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit40034cf76e5258abccee4bd719727545
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Riverskies\\Laravel\\MobileDetect\\' => 32,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'I' => 
        array (
            'Intervention\\Image\\' => 19,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Riverskies\\Laravel\\MobileDetect\\' => 
        array (
            0 => __DIR__ . '/..' . '/riverskies/laravel-mobile-detect/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Intervention\\Image\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/image/src/Intervention/Image',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Detection' => 
            array (
                0 => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/namespaced',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Mobile_Detect' => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/Mobile_Detect.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit40034cf76e5258abccee4bd719727545::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit40034cf76e5258abccee4bd719727545::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit40034cf76e5258abccee4bd719727545::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit40034cf76e5258abccee4bd719727545::$classMap;

        }, null, ClassLoader::class);
    }
}
