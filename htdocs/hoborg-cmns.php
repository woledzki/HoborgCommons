<?php
// main include
require_once __DIR__ . '/../application/Commons/conf/init.php';

use Symfony\Component\HttpFoundation\Request;
use Hoborg\Commons\Kernel;

$kernel = new Kernel('dev', true);
$kernel->loadClassCache();
$kernel->handle(Request::createFromGlobals())->send();