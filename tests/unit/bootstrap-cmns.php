<?php
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));


// Autoloader
/*
if (file_exists($file = __DIR__.'/../autoload.php')) {
    require_once $file;
} elseif (file_exists($file = __DIR__.'/../autoload.php.dist')) {
    require_once $file;
}
*/

require_once __DIR__.'/../../vendors/Symfony2/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony\\Tests' => __DIR__ . '..//../vendors/Symfony2/tests',
    'Symfony' => __DIR__ . '/../../vendors/Symfony2/src',
    'Hoborg\\Tests' => __DIR__ . '',
    'Hoborg' => __DIR__ . '/../../src',
));

$loader->register();
