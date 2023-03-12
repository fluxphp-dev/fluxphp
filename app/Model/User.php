<?php

namespace FluxPHP\App\Model;

use FluxPHP\Source\Model;

class User
{
    use Model;

    public function __construct()
    {
        $this->setup("users");
    }
}