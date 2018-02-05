<?php
/*
*
* @ Package: Router - simple router class for php
* @ Class: RouterCommand
* @ Author: izni burak demirtas / @izniburak <info@burakdemirtas.org>
* @ Web: http://burakdemirtas.org
* @ URL: https://github.com/izniburak/php-router
* @ Licence: The MIT License (MIT) - Copyright (c) - http://opensource.org/licenses/MIT
*
*/
namespace Buki\Router;

use Buki\Router\RouterException;

class RouterCommand
{
    /**
     * Class instance variable
     */
    protected static $instance = null;

    /**
     * Get class instance
     *
     * @return PdoxObject
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * Throw new Exception for Router Error
     *
     * @return RouterException
     */
    public function exception($message = '')
    {
        return new RouterException($message);
    }

    /**
     * Run Route Middlewares
     *
     * @return true | false
     */
    public function beforeAfter($command, $middleware, $path = '', $namespace = '')
    {
        if(!is_null($command)) {
            if(is_array($command)) {
                foreach ($command as $key => $value) {
                    $this->beforeAfter($value, $middleware, $path, $namespace);
                }
            }
            elseif(is_object($command)) {
                return call_user_func($command);
            }
            elseif(strstr($command, '@')) {
                $segments = explode('@', $command);
				$middlewareClass = str_replace([$namespace, '\\', '.'], ['', '/', '/'], $segments[0]);
				$middlewareMethod = $segments[1];

				$middlewareFile = realpath($path . $middlewareClass . '.php');
                if(!file_exists($middlewareFile)) {
                    return $this->exception($middlewareClass . ' Middleware File is not found. Please, check file.');
                }
                require_once($middlewareFile);
                $middlewareClass = $namespace . str_replace('/', '\\', $middlewareClass);
                $controller = new $middlewareClass();

                if(in_array($middlewareMethod, get_class_methods($controller))) {
                    return call_user_func([$controller, $middlewareMethod]);
                } else {
                    return $this->exception($middlewareMethod . ' method is not found in <b>'.$middlewareClass.'</b> middleware. Please, check file.');
                }
            } else {
                if(!is_null($middleware[$command]) && isset($middleware[$command])) {
                    $this->beforeAfter($middleware[$command], $middleware, $path, $namespace);
                } else {
                    return false;
                }
            }
        }
        else {
            return false;
        }
    }

    /**
     * Run Route Command; Controller or Closure
     *
     * @return null
     */
    public function runRoute($command, $params = null, $path = '', $namespace = '')
    {
        if(!is_object($command)) {

			$segments = explode('@', $command);
			$controllerClass = str_replace([$namespace, '\\', '.'], ['', '/', '/'], $segments[0]);
			$controllerMethod = $segments[1];

			$controllerFile = realpath($path . $controllerClass . '.php');
			if(!file_exists($controllerFile)) {
				return $this->exception($controllerClass . ' Controller File is not found. Please, check file.');
			}
			require_once($controllerFile);
			$controllerClass = $namespace . str_replace('/', '\\', $controllerClass);
			$controller = new $controllerClass();

            if(!is_null($params) && in_array($controllerMethod, get_class_methods($controller))) {
                echo call_user_func_array([$controller, $controllerMethod], $params);
            }
            elseif(is_null($params) && in_array($controllerMethod, get_class_methods($controller))) {
                echo call_user_func([$controller, $controllerMethod]);
            } else {
                return $this->exception($controllerMethod . ' method is not found in '.$controllerClass.' controller. Please, check file.');
            }
        } else {
            if(!is_null($params)) {
                echo call_user_func_array($command, $params);
            } else {
                echo call_user_func($command);
            }
        }
    }
}
