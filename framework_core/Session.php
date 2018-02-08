<?php

namespace Framework\Utills;

class Session
{
    private $_sessionArray = array();
    private $config;

    public function __construct()
    {
      $this->config = new \App\Config();
    }

    public function startSession()
    {
        session_start();
    }


    public function addSessionVariable($name, $value)
    {
        $_SESSION[$this->config->session['session_name']] = [$name => $value];
    }

    public function setSessionVariable($name, $value)
    {
        $_SESSION[$this->config->session['session_name']] = [$name => $value];
    }

    public function getSessionVariable($name)
    {
        return $_SESSION[$this->config->session['session_name']][$name];
    }

    public function deleteSessionVariable($name)
    {
        unset($_SESSION[$this->config->session['session_name']] [$name]);
    }
}
