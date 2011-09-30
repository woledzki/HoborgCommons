<?php

require_once H_VENDOR .  '/Symfony2/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
//use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
	'Hoborg' => H_ROOT . '/src',
	'Symfony' => H_VENDOR . '/Symfony2/src',
	'Doctrine\\Common' => H_VENDOR . '/DoctrineCommon/lib',
	'Doctrine\\DBAL'   => H_VENDOR . '/DoctrineDBAL/lib',
	'Doctrine'         => H_VENDOR . '/Doctrine2/lib',
	'Monolog'          => H_VENDOR . '/Monolog/src',
));
$loader->registerPrefixes(array(
	'Twig_Extensions_' => __DIR__.'/../vendor/TwigExtensions/lib',
	'Twig_' => H_VENDOR . '/Twig/lib',
));

// intl
if (!function_exists('intl_get_error_code')) {
//    require_once __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

//    $loader->registerPrefixFallbacks(array(__DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs'));
}

$loader->registerNamespaceFallbacks(array(
    H_ROOT . '/src',
));

$loader->register();

require_once __DIR__ . '/../Kernel.php';