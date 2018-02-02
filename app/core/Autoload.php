<?php

class Autoload {


  public function __construct(){
    $this->load();
  }

  private function load(){
    $directories = array(
            DOC_ROOT.'/app/controllers/'
          );
foreach ($directories as $directory) {
    foreach(glob($directory . "*.php") as $class) {
        include_once $class;
    }
  }


}

}
