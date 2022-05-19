<?php

use App\Router;

define('ROOT', dirname(__DIR__));

require 'vendor/autoload.php';



/**
 * Page content init
 */
$rooter = Router::getRouter();
try {
    $rooter->init();
} catch (Exception $e) {

}
