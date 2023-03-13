<?php

namespace FluxPHP\Source\Class;

use FluxPHP\Source\View\Token;

class Route
{
    protected array $route;

    public function __construct()
    {
        $this->route = [];
    }

    public function get($url, $callback)
    {
        $url = preg_replace("/{.+}/", "(.+)", $url);
        $this->route["GET"][$url] = $callback;
    }

    public function post($url, $callback)
    {
        $url = preg_replace("/{.+}/", "(.+)", $url);
        $this->route["POST"][$url] = $callback;
    }

    public function delete($url, $callback)
    {
        $url = preg_replace("/{.+}/", "(.+)", $url);
        $this->route["DELETE"][$url] = $callback;
    }

    public function put($url, $callback)
    {
        $url = preg_replace("/{.+}/", "(.+)", $url);
        $this->route["PUT"][$url] = $callback;
    }

    public function patch($url, $callback)
    {
        $url = preg_replace("/{.+}/", "(.+)", $url);
        $this->route["PUT"][$url] = $callback;
    }

    public function run()
    {
        if (!isset($this->route["POST"])) {
            $this->route["POST"] = [];
        }
        $url = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];

        $callback = null;
        $param = [];
        foreach ($this->route[$method] as $route => $handler) {
            if (preg_match("%^{$route}$%", $url, $matches) === 1) {
                $callback = $handler;
                unset($matches[0]);
                $param = $matches;
                break;
            }
        }

        if (is_callable($callback)) {
            echo call_user_func($callback, ...$param);
        } elseif (is_array($callback)) {
            $instance = new $callback[0];
            $instance->{$callback[1]}(...$param);
        } else {
            echo '<!doctype html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><script src="https://cdn.tailwindcss.com"></script></head><body><div class="flex h-screen bg-gradient-to-r from-green-400 to-blue-400 bg-clip-text text-transparent"><div class="m-auto"><h1 class="text-6xl font-bold">404</h1><span class="text-lg text-center">Not Found</span></div></div></body></html>';
        }
    }
}