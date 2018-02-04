<?php

class ClassLoader
{
    public function __construct()
    {
        $this->load();
    }

    private function load()
    {
        $directories = array(
            DOC_ROOT.'/app/controllers/',
            DOC_ROOT.'/app/models/'

          );
        foreach ($directories as $directory) {
            foreach (glob($directory . "*.php") as $class) {
                include_once $class;
            }
        }
    }
}
