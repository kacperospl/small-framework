<?php
/*
*
* @ Package: Router - simple router class for php
* @ Class: Router
* @ Author: izni burak demirtas / @izniburak <info@burakdemirtas.org>
* @ Web: http://burakdemirtas.org
* @ URL: https://github.com/izniburak/php-router
* @ Licence: The MIT License (MIT) - Copyright (c) - http://opensource.org/licenses/MIT
*
*/
namespace Buki;

use Buki\Router\RouterRequest;
use Buki\Router\RouterCommand;
use Buki\Router\RouterException;

class Router
{
    protected $baseFolder;

    protected $routes = [];
    protected $middlewares = [];
    protected $groups = [];

    protected $patterns = [
        '{a}' => '([^/]+)',
        '{d}' => '([0-9]+)',
        '{i}' => '([0-9]+)',
        '{s}' => '([a-zA-Z]+)',
        '{w}' => '([a-zA-Z0-9_]+)',
        '{u}' => '([a-zA-Z0-9_-]+)',
        '{*}' => '(.*)'
    ];

    protected $namespaces = [
        'middlewares' => '',
        'controllers' => ''
    ];

    protected $paths = [
        'controllers' => 'Controllers',
        'middlewares' => 'Middlewares'
    ];

    protected $errorCallback;

    /**
     * Router constructer method.
     *
     * @return
     */
    function __construct(Array $params = [])
    {
        $this->baseFolder = realpath(getcwd());

        if(is_null($params) || empty($params)) {
            return;
        }

        if(isset($params['debug']) && is_bool($params['debug'])) {
            RouterException::$debug = $params['debug'];
        }

        if(isset($params['paths']) && $paths = $params['paths']) {
            $this->paths['controllers']	= (
                isset($paths['controllers']) ? $this->baseFolder . '/' . trim($paths['controllers'], '/') . '/' : $this->paths['controllers']
            );
            $this->paths['middlewares']	= (
                isset($paths['middlewares']) ? $this->baseFolder . '/' . trim($paths['middlewares'], '/') . '/' : $this->paths['middlewares']
            );
        }

        if(isset($params['namespaces']) && $namespaces = $params['namespaces']) {
            $this->namespaces['controllers']	= (
                isset($namespaces['controllers']) ? trim($namespaces['controllers'], '\\') . '\\' : ''
            );
            $this->namespaces['middlewares']	= (
                isset($namespaces['middlewares']) ? trim($namespaces['middlewares'], '\\') . '\\' : ''
            );
        }
    }

    /**
     * Add route method;
     * Get, Post, Put, Delete, Patch, Any, Ajax...
     *
     * @return
     */
    public function __call($method, $params)
    {
        if(is_null($params)) {
            return;
        }

        if( !in_array(strtoupper($method), explode('|', RouterRequest::$validMethods)) ) {
            return $this->exception($method . ' is not valid.');
        }

        $route = $params[0];
        $callback = $params[1];
        $settings = null;

        if(count($params) > 2) {
            $settings = $params[1];
            $callback = $params[2];
        }

        if(strstr($route, '{')) {
            $route1 = $route2 = '';
            foreach(explode('/', $route) as $key => $value) {
                if($value != '') {
                    if(!strpos($value, '?')) {
                        $route1 .= '/' . $value;
                    } else {
                        if($route2 == '') {
                            $this->addRoute($route1, $method, $callback, $settings);
                        }
                        $route2 = $route1 . '/' . str_replace('?', '', $value);
                        $this->addRoute($route2, $method, $callback, $settings);
                        $route1 = $route2;
                    }
                }
            }

            if($route2 == '') {
                $this->addRoute($route1, $method, $callback, $settings);
            }
        } else {
            $this->addRoute($route, $method, $callback, $settings);
        }
        return;
    }

    /**
     * Add new route method one or more http methods.
     *
     * @return null
     */
    public function add($methods, $route, $settings, $callback = null)
    {
        if(is_null($callback)) {
            $callback = $settings;
            $settings = null;
        }

        if(strstr($methods, '|')) {
            foreach (array_unique(explode('|', $methods)) as $method) {
                if($method != '') {
                    call_user_func_array([$this, strtolower($method)], [$route, $settings, $callback]);
                }
            }
        } else {
            call_user_func_array([$this, strtolower($methods)], [$route, $settings, $callback]);
        }

        return;
    }

    /**
     * Add new route rules pattern; String or Array
     *
     * @return
     */
    public function pattern($pattern, $attr = null)
    {
        if(is_array($pattern)) {
            foreach ($pattern as $key => $value) {
                if(!in_array('{' . $key . '}', array_keys($this->patterns))) {
                    $this->patterns['{' . $key . '}'] = '(' . $value . ')';
                } else {
                    return $this->exception($key . ' pattern cannot be changed.');
                }
            }
        } else {
            if(!in_array('{' . $pattern . '}', array_keys($this->patterns))) {
                $this->patterns['{' . $pattern . '}'] = '(' . $attr . ')';
            } else {
                return $this->exception($pattern . ' pattern cannot be changed.');
            }
        }

        return;
    }

    /**
     * Add new middleware
     *
     * @return null
     */
    public function middleware($name, $command)
    {
        $this->middlewares[$name] = $command;
    }

    /**
     * Run Routes
     *
     * @return true | throw Exception
     */
    public function run()
    {
        $documentRoot = realpath($_SERVER['DOCUMENT_ROOT']);
        $getCwd = realpath(getcwd());

        $base = str_replace('\\', '/', str_replace($documentRoot, '', $getCwd) . '/');
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if(($base != $uri) && (substr($uri, -1) == '/')) {
            $uri = substr($uri, 0, (strlen($uri)-1));
        }
        if($uri === '') {
            $uri = '/';
        }

        $method = RouterRequest::getRequestMethod();
        $searches = array_keys($this->patterns);
        $replaces = array_values($this->patterns);
        $foundRoute = false;

        $routes = [];
        foreach ($this->routes as $data) {
            array_push($routes, $data['route']);
        }

        // check if route is defined without regex
        if (in_array($uri, array_values($routes))) {
            foreach ($this->routes as $data) {
                if (RouterRequest::validMethod($data['method'], $method) && ($data['route'] == $uri)) {
                    $foundRoute = true;
                    $this->runRouteMiddleware($data, 'before');
                    $this->runRouteCommand($data['callback']);
                    $this->runRouteMiddleware($data, 'after');
                    break;
                }
            }
        } else {
            foreach ($this->routes as $data) {
                $route = $data['route'];

                if (strpos($route, '{') !== false) {
                    $route = str_replace($searches, $replaces, $route);
                }

                if (preg_match('#^' . $route . '$#', $uri, $matched)) {
                    if (RouterRequest::validMethod($data['method'], $method)) {
                        $foundRoute = true;

                        $this->runRouteMiddleware($data, 'before');

                        array_shift($matched);
                        $newMatched = [];
                        foreach ($matched as $key => $value) {
                            if(strstr($value, '/')) {
                                foreach (explode('/', $value) as $k => $v) {
                                    $newMatched[] = trim(urldecode($v));
                                }
                            } else {
                                $newMatched[] = trim(urldecode($value));
                            }
                        }
                        $matched = $newMatched;

                        $this->runRouteCommand($data['callback'], $matched);
                        $this->runRouteMiddleware($data, 'after');
                        break;
                    }
                }
            }
        }

        // If it originally was a HEAD request, clean up after ourselves by emptying the output buffer
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'HEAD') {
            ob_end_clean();
        }

        if ($foundRoute == false) {
            if (!$this->errorCallback) {
                $this->errorCallback = function() {
                    header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
                    return $this->exception('Route not found. Looks like something went wrong. Please try again.');
                };
            }
            call_user_func($this->errorCallback);
        }
    }

    /**
     * Routes Group
     *
     * @return null
     */
    public function group($name, $settings = null, $callback = null)
    {
        $groupName = trim($name, '/');
        $group = [];
        $group['route'] = '/' . $groupName;
        $group['before'] = $group['after'] = null;

        if(is_null($callback)) {
            $callback = $settings;
        } else {
            $group['before'][] = (!isset($settings['before']) ? null : $settings['before']);
            $group['after'][]    = (!isset($settings['after']) ? null : $settings['after']);
        }

        $groupCount = count($this->groups);
        if($groupCount > 0) {
            $list = [];
            foreach ($this->groups as $key => $value) {
                if(is_array($value['before'])) {
                    foreach($value['before'] as $k => $v) {
                        $list['before'][] = $v;    
                    }
                    foreach($value['after'] as $k => $v) {
                        $list['after'][] = $v;    
                    }
                } 
            }

            if(!is_null($group['before'])) {
                $list['before'][] = $group['before'][0];
            }

            if(!is_null($group['after'])) {
                $list['after'][] = $group['after'][0];
            }

            $group['before'] = $list['before'];
            $group['after'] = $list['after'];
        }

        $group['before'] = array_values(array_unique($group['before']));
        $group['after'] = array_values(array_unique($group['after']));

        array_push($this->groups, $group);

        if(is_object($callback)) {
            call_user_func_array($callback, [$this]);
        }

        $this->endGroup();
    }

    /**
     * Added route from methods of Controller file.
     *
     * @return null
     */
    public function controller($route, $controller)
    {
        $controller = str_replace(['\\', '.'], '/', $controller);
        $controllerFile = realpath(
            $this->paths['controllers'] . $controller . '.php'
        );
        if(file_exists($controllerFile)) {
            if(!class_exists($controller)) {
                $req = require($controllerFile);
            }
        } else {
            return $this->exception($controller . " controller file is not found! Please, check file.");
        }

        $controller = str_replace('/', '\\', $controller);
        $classMethods = get_class_methods($this->namespaces['controllers'] . $controller);
        if($classMethods) {
            foreach ($classMethods as $methodName) {
                if(!strstr($methodName, '__')) {
                    $method = "any";
                    foreach(explode('|', RouterRequest::$validMethods) as $m) {
                        if(stripos($methodName, strtolower($m), 0) === 0) {
                            $method = strtolower($m);
                            break;
                        }
                    }

                    $methodVar = lcfirst(str_replace($method, '', $methodName));
                    $r = new \ReflectionMethod($this->namespaces['controllers'] . $controller, $methodName);
                    $paramNum = $r->getNumberOfRequiredParameters();
                    $paramNum2 = $r->getNumberOfParameters();

                    $value = ($methodVar == 'main' ? $route : $route . '/' . $methodVar);
                    $this->{$method}(($value . str_repeat('/{a}', $paramNum) . str_repeat('/{a?}', $paramNum2 - $paramNum)), ($controller . '@' . $methodName));
                }
            }
            unset($r);
        }

        $req = null;
    }

    /**
     * Routes error function. (Closure)
     *
     * @return null
     */
    public function error($callback)
    {
        $this->errorCallback = $callback;
    }

    /**
     * Add new Route and it's settings
     *
     * @return null
     */
    private function addRoute($uri, $method, $callback, $settings)
    {
        $groupItem = count($this->groups) - 1;
        $group = '';
        if($groupItem > -1) {
            foreach ($this->groups as $key => $value) {
                $group .= $value['route'];
            }
        }

        $page = dirname($_SERVER['PHP_SELF']);
        $page = $page == '/' ? '' : $page;
        if(strstr($page, 'index.php')) {
            $data = implode('/', explode('/', $page));
            $page = str_replace($data, '', $page);
        }

        $route = $page . $group . '/' . trim($uri, '/');
        $route = rtrim($route, '/');
        if($route == $page) {
            $route .= '/';
        }

        $data = [
            'route' => $route,
            'method' => strtoupper($method),
            'callback' => (is_object($callback) ? $callback : $this->namespaces['controllers'] . $callback),
            'alias' => (isset($settings['alias']) ? $settings['alias'] : (isset($settings['as']) ? $settings['as'] : null)),
            'before' => (isset($settings['before']) ? (!is_array($settings['before']) && !is_object($settings['before']) && strstr($settings['before'], '@') ? $this->namespaces['middlewares'] . $settings['before'] : $settings['before'] ) : null),
            'after' => (isset($settings['after']) ? (!is_array($settings['after']) && !is_object($settings['after']) && strstr($settings['after'], '@') ? $this->namespaces['middlewares'] . $settings['after'] : $settings['after'] ) : null),
            'group' => ($groupItem === -1) ? null : $this->groups[$groupItem]
        ];
        array_push($this->routes, $data);
    }

    /**
     * Run Route Command; Controller or Closure
     *
     * @return null
     */
    private function runRouteCommand($command, $params = null)
    {
        $this->routerCommand()->runRoute(
            $command, $params, $this->paths['controllers'], $this->namespaces['controllers']
        );
    }

    /**
     * Detect Routes Middleware; before or after
     *
     * @return null
     */
    public function runRouteMiddleware($middleware, $type)
    {
        if($type == 'before') {
            if(!is_null($middleware['group'])) {
                $this->routerCommand()->beforeAfter(
                    $middleware['group'][$type], $this->middlewares, $this->paths['middlewares'], $this->namespaces['middlewares']
                );
            }
            $this->routerCommand()->beforeAfter(
                $middleware[$type], $this->middlewares, $this->paths['middlewares'], $this->namespaces['middlewares']
            );
        } else {
            $this->routerCommand()->beforeAfter(
                $middleware[$type], $this->middlewares, $this->paths['middlewares'], $this->namespaces['middlewares']
            );
            if(!is_null($middleware['group'])) {
                $this->routerCommand()->beforeAfter(
                    $middleware['group'][$type], $this->middlewares, $this->paths['middlewares'], $this->namespaces['middlewares']
                );
            }
        }
    }

    /**
     * Routes Group endpoint
     *
     * @return null
     */
    private function endGroup()
    {
        array_pop($this->groups);
    }

    /**
     * Display all Routes.
     *
     * @return null
     */
    public function getList()
    {
        echo '<pre style="border:1px solid #eee;padding:0 10px;width:960px;max-height:780;margin:20px auto;font-size:17px;overflow:auto;">';
        var_dump($this->getRoutes());
        echo '</pre>';
        die();
    }

    /**
     * Get all Routes
     *
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
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
     * RouterCommand class
     *
     * @return RouterCommand
     */
    public function routerCommand()
    {    
        return RouterCommand::getInstance();
    }
}
