<?php

namespace FluxPHP\Source\Class;

use FluxPHP\Source\CLI\Migrate;
use FluxPHP\Source\CLI\MigrateDown;
use FluxPHP\Source\CLI\Start;
use Symfony\Component\Console\Application;

class Console
{
    public static function init()
    {
        $app = new Application("FluxPHP", "1.0.0");
        $app->add(new Start);
        $app->add(new Migrate);
        $app->add(new MigrateDown);
        $app->run();
    }
}
