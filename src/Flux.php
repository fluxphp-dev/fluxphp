<?php

namespace FluxPHP\Source;

class Flux
{
    public static function getEnv(string $env, string $alt = "")
    {
        return $_ENV[$env] ?? $alt;
    }
}
