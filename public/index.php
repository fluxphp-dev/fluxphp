<?php

/**
 * Autoload
 */


require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;
use FluxPHP\Source\Database\Migration;

/**
 * Env
 */
$cfg = Dotenv::createImmutable(dirname(__DIR__));
$cfg->load();

require_once __DIR__ . "/../src/Common.php";
require_once __DIR__ . "/../routes/main.php";