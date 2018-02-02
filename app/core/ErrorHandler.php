<?php

class ErrorHandler
{

public static function error($msg)
{
    echo '
      <div id="error_msg">
        <h1>Error!</h1>
        <h3>'. $msg .'</h3>

      </div>
    ';
}


}


?>
