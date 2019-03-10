<?php

	use app\model\{Cart, Products, Orders};
	use app\engine\Db;

	include __DIR__ . '/../engine/Autoload.php';

	spl_autoload_register([new Autoload(), 'loadClass']);

	$product = new Products(new Db());
	$order = new Orders(new Db());
	$cart = new Cart(new Db());

	var_dump($product);
	var_dump($order);
	var_dump($cart);
