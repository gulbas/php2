<?php

	use app\engine\Autoload;
	use app\model\{Products, Users};

	include __DIR__ . '/../engine/Autoload.php';
	include __DIR__ . '/../config/config.php';


	spl_autoload_register([new Autoload(), 'loadClass']);


	$product = new Products(null, 'Продукт', 'Описание продукта', 100, 1, 1);
	$product->insert();
	$product->delete();
	$product->update();


	echo '--- Объекты ---';
	var_dump($product->getOneObject(2));
	var_dump($product->getAllObjects());
