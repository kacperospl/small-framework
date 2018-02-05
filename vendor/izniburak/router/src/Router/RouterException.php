<?php
/*
*
* @ Package: Router - simple router class for php
* @ Class: RouterException
* @ Author: izni burak demirtas / @izniburak <info@burakdemirtas.org>
* @ Web: http://burakdemirtas.org
* @ URL: https://github.com/izniburak/php-router
* @ Licence: The MIT License (MIT) - Copyright (c) - http://opensource.org/licenses/MIT
*
*/
namespace Buki\Router;

use Exception;

class RouterException
{
    public static $debug = false;

    /**
     * Create Exception Class.
     *
     * @return string | Exception
     */
    public function __construct($message)
    {
        if(self::$debug) {
            throw new Exception($message, 1);
        } else {
            die('<h2>Opps! An error occurred.</h2> ' . $message);
        }
    }
}
