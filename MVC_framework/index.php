<?php

require_once 'global/config.php';
require_once 'global/utils.php';
require_once 'models/model_base.php';
require_once 'controllers/controller_base.php';

define('BASEURL', dirname($_SERVER['SCRIPT_NAME']));

// init DB connection
try {
	$db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
}
catch (Exception $e) {
	$c = new Controller_Base();
	http_response_code(500);
	$c->render_view('errors/500');
	exit;
}

// set static $db instance
Model_Base::set_db($db);

session_set_cookie_params(6000, '/', '', false, true);
session_start();

date_default_timezone_set('Europe/Paris');

if(isset($_SERVER['PATH_INFO'])) {
	$args = explode('/', $_SERVER['PATH_INFO']);

	// if route = 'index.php' or 'index.php/' : load home
	if (count($args) == 1 || (count($args) == 2 && empty($args[1]))) {
		require_once 'controllers/home.php';
		$c = new Controller_Home();
		$c->index();
		exit;
	}

	else if (count($args) >= 2) {
		$controller = $args[1];

		// if route = 'index.php/ctrl/' : call index method of ctrl
		if (count($args) == 2 || (count($args) == 3 && empty($args[2]))) {
			$method = 'index';
		} else {
			$method = $args[2];
		}

		$params = array();
		for ($i = 3; $i < count($args); $i++) {
			$params[] = $args[$i];
		}

		$controller_file = dirname(__FILE__).'/controllers/'.$controller.'.php';
		if (is_file($controller_file)) {
			require_once $controller_file;
			// underscored to upper-camelcase 
			// e.g. "this_controller_name" -> "ThisControllerName" 
			$controller = preg_replace_callback('/(?:^|_)(.?)/', function($m) { return strtoupper($m[1]); }, $controller);
			$controller_name = 'Controller_'.$controller;
			if (class_exists($controller_name)) {
				$c = new $controller_name;
				if (method_exists($c, $method)) {
					call_user_func_array(array($c, $method), $params);
					exit;
				}
			}
		}
	}
} else {
	// if PATH_INFO is not defined : load home
	require_once 'controllers/home.php';
	$c = new Controller_Home();
	$c->index();
	exit;
}

// if we get here : return 404
$c = new Controller_Base();
http_response_code(404);
$c->render_view('errors/404');
