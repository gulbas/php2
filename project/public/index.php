<?php

	use app\engine\Autoload;
	// use app\model\Products;

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


	/*$product = Products::getOneObject(8);
	$product->setQuantity(8);
	$product->setCategoryId(4);
	$product->update();
	var_dump($product);
	// $product->update();*/