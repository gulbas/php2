<?php

	use app\engine\Autoload;

	include __DIR__ . '/../engine/Autoload.php';
	include __DIR__ . '/../config/config.php';

	spl_autoload_register([new Autoload(), 'loadClass']);

	$controllerName = $_GET['c'] ?: 'product';
	$actionName = $_GET['a'];

	$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . 'Controller';

	if (class_exists($controllerClass)) {
		$controller = new $controllerClass();
		$controller->runAction($actionName);
	}

