<?php

namespace Framework;

define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);




require_once DOC_ROOT . '/app/config.php';
require_once 'Helper.php';
require_once 'ClassLoader.php';
require_once 'Database.php';
require_once 'Session.php';
require_once 'View.php';

require_once 'ErrorHandler.php';
require_once 'Controller.php';

require_once 'Model.php';


require_once 'Application.php';

use App\Config;

use Framework\Utills\Helper as Helper;

use Framework\Core\ClassLoader as ClassLoader;
use Framework\Utills\Database as DataBase;
use Framework\Utills\Session as Session;
use Framework\Utills\ErrorHandler as ErrorHandler;
use Framework\Core\Controller as Controller;
use Framework\Core\Model as Model;
use Framework\Core\View as View;
use Framework\Core\Application as Application;

$autoload = new ClassLoader();
