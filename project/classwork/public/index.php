<?php

	use app\model\{Products, Users};
	use app\engine\Autoload;

	include __DIR__ . '/../engine/Autoload.php';
	include __DIR__ . '/../config/config.php';


	spl_autoload_register([new Autoload(), 'loadClass']);

//	$product = new Products(new Db());
//	$order = new Orders(new Db());
//	$cart = new Cart(new Db());
//
//	var_dump($product);
//	var_dump($order);
//	var_dump($cart);

//	$db = new Db();
	$product = new Products();
//	var_dump($db->queryOne('SELECT * FROM products WHERE id=:id', [':id' => 1]));
	var_dump($product->getAll());
	$users = new Users();
	var_dump($users->getOne(1));