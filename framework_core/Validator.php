<?php
namespace Framework\Utills;

class Validator
{

  public function __construct()
  {

  }

  public function get($name)
  {
    if(isset($_GET[$name])){
      return $_GET[$name];

    }else {
      return false;
    }
  }

  public function post($name)
  {
    if(isset($_POST[$name])){
    return htmlspecialchars($_POST[$name],ENT_QUOTES);
  }else {
    return false;
  }
  }


}
