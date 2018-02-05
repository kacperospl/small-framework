<?php

class Login_controller
{

  public function __construct()
  {
    parent::__construct();
    echo 'construct';
  }

  public function login($login,$password)
  {
    echo "test";
    echo $login;
    echo '<br>';
    echo $password;
  }


}
