<?php

namespace Framework\Utills;

class Session
{
    private static $_sessionArray = array();

    public static function StartSession()
    {
        session_start();
    }


    public static function AddSessionVariable($name, $value)
    {
        $_SESSION[\App\Config::$session['session_name']] = [$name => $value];
    }

    public static function GetSessionVariable($name)
    {
        return $_SESSION[\App\Config::$session['session_name']][$name];
    }

    public static function DeleteSessionVariable($name)
    {
        unset($_SESSION[\App\Config::$session['session_name']] [$name]);
    }
}
