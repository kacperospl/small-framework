<?php

class ErrorHandler
{
    public static function Error($msg)
    {
        echo '
      <style>
      #error_msg {
        background-color:red;
      }
      </style>
      <div id="error_msg">
        <h1>Error!</h1>
        <h3>'. $msg .'</h3>

      </div>
    ';
    }
}
