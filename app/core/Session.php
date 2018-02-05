<?php

class Session
{

  private static $_sessionArray = array();

  public static function StartSession()
  {
    session_start();
  }

  public static function AddSessionVariable($name,$value)
  {
    $_SESSION[Config::$session['session_name']] = [$name => $value];
  }

  public static function GetSessionVariable($name)
  {
    return $_SESSION[Config::$session['session_name']][$name];
  }

}
