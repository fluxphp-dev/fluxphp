<?php

/**
 * Functions
 */


use FluxPHP\Source\View\Render;

if (!function_exists("view")) {
    function view(string $file, array $data = [])
    {
        new Render(dirname(__DIR__), $file, $data);
    }
}
