<?php
/*
*
* @ Package: Router - simple router class for php
* @ Class: RouterRequest
* @ Author: izni burak demirtas / @izniburak <info@burakdemirtas.org>
* @ Web: http://burakdemirtas.org
* @ URL: https://github.com/izniburak/php-router
* @ Licence: The MIT License (MIT) - Copyright (c) - http://opensource.org/licenses/MIT
*
*/
namespace Buki\Router;

class RouterRequest
{
    public static $validMethods = 'GET|POST|PUT|DELETE|HEAD|OPTIONS|PATCH|ANY|AJAX|AJAXP';

    /**
     * method status
     *
     * @return true|false
     */
    public static function validMethod($data, $method)
    {
        $valid = false;
        if(strstr($data, '|')) {
            foreach (explode('|', $data) as $value) {
                $valid = self::checkMethods($value, $method);
                if($valid) break;
            }
        } else {
            $valid = self::checkMethods($data, $method);
        }
        return $valid;
    }

    /**
     * check method valid
     *
     * @return true|false
     */
    private static function checkMethods($value, $method)
    {
        $valid = false;
        if($value == 'AJAX' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && $value == $method) {
            $valid = true;
        } elseif($value == 'AJAXP' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && $method == 'POST') {
            $valid = true;
        } elseif(in_array($value, explode('|', self::$validMethods)) && ($value == $method || $value == 'ANY')) {
            $valid = true;
        }
        return $valid;
    }

    /**
     * Get all request headers
     *
     * @return array The request headers
     */
    private static function getRequestHeaders()
    {
        // If getallheaders() is available, use that
        if (function_exists('getallheaders')) {
            return getallheaders();
        }

        // Method getallheaders() not available: manually extract 'm
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH')) {
                $headers[str_replace([' ', 'Http'], ['-', 'HTTP'], ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $headers;
    }

    /**
     * Get the request method used, taking overrides into account
     *
     * @return string The Request method to handle
     */
    public static function getRequestMethod()
    {
        // Take the method as found in $_SERVER
        $method = $_SERVER['REQUEST_METHOD'];
        // If it's a HEAD request override it to being GET and prevent any output, as per HTTP Specification
        // @url http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.4
        if ($method == 'HEAD') {
            ob_start();
            $method = 'GET';
        } // If it's a POST request, check for a method override header
        elseif ($method == 'POST') {
            $headers = self::getRequestHeaders();
            if (isset($headers['X-HTTP-Method-Override']) && in_array($headers['X-HTTP-Method-Override'], ['PUT', 'DELETE', 'PATCH', 'OPTIONS'])) {
                $method = $headers['X-HTTP-Method-Override'];
            } elseif(!empty($_POST['_method'])) {
                $method = strtoupper($_POST['_method']);
            }
        }

        return $method;
    }
}
