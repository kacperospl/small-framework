<?php

namespace Framework\Utills;

class Session
{
    private  $_sessionArray = array();

    public  function startSession()
    {
        session_start();
    }


    public  function addSessionVariable($name, $value)
    {
        $_SESSION[\App\Config::$session['session_name']] = [$name => $value];
    }

    public function setSessionVariable($name,$value)
    {
        $_SESSION[\App\Config::$session['session_name']] = [$name => $value];
    }

    public  function getSessionVariable($name)
    {
        return $_SESSION[\App\Config::$session['session_name']][$name];
    }

    public  function deleteSessionVariable($name)
    {
        unset($_SESSION[\App\Config::$session['session_name']] [$name]);
    }
}
