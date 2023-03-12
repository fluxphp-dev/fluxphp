<?php

use FluxPHP\App\Controller\HomeController;
use FluxPHP\App\Model\User;
use FluxPHP\Source\Class\Route;

/**
 * Create new route instance
 */
$route = new Route();

$route->get("/", [HomeController::class, "index"]);

$route->run();
