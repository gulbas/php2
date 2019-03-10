<?php

	use app\model\Cart;
	use app\model\Products;
	use app\engine\Db;
	use app\model\Orders;

	include __DIR__ . '/../engine/Autoload.php';

	spl_autoload_register([new Autoload(), 'loadClass']);

	$product = new Products(new Db());
	$order = new Orders(new Db());
	$cart = new Cart(new Db());

	var_dump($product);
	var_dump($order);
	var_dump($cart);
