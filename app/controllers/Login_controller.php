<?php

class Login_controller extends Controller
{



  public function index()
  {

  }

  public function login()
  {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $this->modelFunction('Login_model','verifyUser',[$login,$password]);
  }


}
