<?php

use FluxPHP\App\Controller\HomeController;
use FluxPHP\App\Model\User;
use FluxPHP\Source\Class\Route;

/**
 * Create new route instance
 */
$route = new Route();

$route->get("/", [HomeController::class, "index"]);
$route->post("/insert", function () {
    // $user = new User();
    // $user->insert([
    //     "name" => "Brumin",
    //     "email" => "brumin@gmail.com",
    //     "password" => base64_encode("password")
    // ]);
    dd($_POST);
});

$route->run();
