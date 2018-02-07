<?php

namespace Framework\Core;

class ClassLoader
{
    public function __construct()
    {
        $this->_load();
    }

    private function _load()
    {
        foreach (\App\Config::$classLoaderPaths as $directory) {
            foreach (glob($directory . "*.php") as $class) {

                require_once $class;

            }
        }
    }
}
