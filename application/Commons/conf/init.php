<?php

define('H_ROOT', realpath(__DIR__ . '/../../../'));
define('H_VENDOR', H_ROOT . '/vendors');
defined('H_ENV')
    || define('H_ENV', false !== getenv('H_ENV') ? getenv('H_ENV') : 'dev');

date_default_timezone_set('UTC');

require_once 'autoload.php';