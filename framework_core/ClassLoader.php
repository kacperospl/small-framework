<?php

class ClassLoader
{
    public function __construct()
    {
        $this->_load();
    }

    private function _load()
    {
        foreach (Config::$classLoaderPaths as $directory) {
            foreach (glob($directory . "*.php") as $class) {
                include_once $class;
            }
        }
    }
}
