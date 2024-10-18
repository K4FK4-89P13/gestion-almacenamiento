<?php
// define('APP_PATH', realpath('..'));
// $config = include APP_PATH . '/app/Config/config.php';
define('APP_PATH', '../');


require_once '../core/Core.php';
require_once '../core/Controller.php';
require_once '../core/Model.php';

$init = new Core();

/* $ruta = $init->get_url();
print_r($ruta); */