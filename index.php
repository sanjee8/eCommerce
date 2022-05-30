<?php

use App\Core\Model\Model;
use App\Router;

define('ROOT', dirname(__DIR__));

require 'vendor/autoload.php';


Model::getModel("Session\\Session")->init();


/**
 * Page content init
 */
$rooter = Router::getRouter();
try {
    $rooter->init();
} catch (Exception $e) {

}


