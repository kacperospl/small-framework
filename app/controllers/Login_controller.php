<?php

class Login_controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function login()
  {
    echo "test";
    echo $_POST["login"];
    echo '<br>';
    echo $_POST["password"];
  }


}
