<?php

	use app\engine\{Autoload, Render, TwigRender, Request};

	include __DIR__ . '/../engine/Autoload.php';
	include __DIR__ . '/../config/config.php';
	require_once __DIR__ . '/../vendor/autoload.php';


	spl_autoload_register([new Autoload(), 'loadClass']);
	$request = new Request();

	$controllerName = $request->getControllerName() ?: 'product';
	$actionName = $request->getActionName();

	$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . 'Controller';

	if (class_exists($controllerClass)) {
		$controller = new $controllerClass(new TwigRender());
		$controller->runAction($actionName);
	}

	/*$product = Products::getOneObject(8);
	$product->setQuantity(8);
	$product->setCategoryId(4);
	$product->update();
	var_dump($product);
	// $product->update();*/