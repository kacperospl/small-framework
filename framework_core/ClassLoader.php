<?php

namespace Framework\Core;

class ClassLoader
{
    private $config;

    public function __construct()
    {
        $this->config = new \App\Config();
        $this->_load();
    }

    private function _load()
    {
        foreach ($this->config->classLoaderPaths as $directory) {
            foreach (glob($directory . "*.php") as $class) {
                require_once $class;
            }
        }
    }
}
