<?php

namespace FluxPHP\Source\View;

class Render
{
    protected $layout;
    protected $blocks = [];
    protected $currentBlock;
    protected $blockStack = [];

    protected $dir;
    protected $name;

    public function __construct($dir, string $name, array $options = array())
    {
        $this->name = str_replace(".php", "", $name);
        $this->dir = $dir;

        $output = (function (): string {
            ob_start();
            include $this->dir . "/app/View/{$this->name}.php";

            return ob_get_clean() ?: '';
        })();

        foreach ($options as $key => $val) {
            $output = str_replace("{{" . $key . "}}", $val, $output);
            $output = str_replace("{{" . $key . " }}", $val, $output);
            $output = str_replace("{{ " . $key . "}}", $val, $output);
            $output = str_replace("{{ " . $key . " }}", $val, $output);
        }

        if ($this->layout !== null && $this->blockStack === []) {
            $layoutView   = $this->layout;
            $this->layout = null;
            $output     = $this->__construct($dir, $layoutView, $options);
        }

        echo $output;
    }

    public function include(string $file)
    {
        $this->__construct($this->dir, $file);
    }

    public function extends(string $layout)
    {
        $this->layout = $layout;
    }

    public function block(string $name)
    {
        $this->currentBlock = $name;
        $this->blockStack[] = $name;

        ob_start();
    }

    public function endBlock()
    {
        $contents = ob_get_clean();

        if ($this->blockStack === []) {
            throw new \RuntimeException('View themes, no current section.');
        }

        $section = array_pop($this->blockStack);

        if (!array_key_exists($section, $this->blocks)) {
            $this->blocks[$section] = [];
        }

        $this->blocks[$section][] = $contents;
    }

    public function yield(string $sectionName)
    {
        if (!isset($this->blocks[$sectionName])) {
            echo '';

            return;
        }

        foreach ($this->blocks[$sectionName] as $key => $contents) {
            echo $contents;
            unset($this->blocks[$sectionName][$key]);
        }
    }
}
