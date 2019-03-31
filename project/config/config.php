<?php

	use app\engine\Request;

	return [
		'ds' => DIRECTORY_SEPARATOR,
		'root_dir' => $_SERVER['DOCUMENT_ROOT'],
		'templates_dir' => __DIR__ . '../views/',
		'twig_dir' => '../views/twig/',
		'controllers_namespaces' => 'app\controllers\\',
		'site' => 'phpoop.local',
		'components' => [
			'db' => [
				'class' => \app\engine\Db::class,
				'driver' => 'mysql',
				'host' => 'localhost',
				'login' => 'root',
				'password' => '',
				'database' => 'shop',
				'charset' => 'utf8'
			],
			'request' => [
				'class' => Request::class
			],
			//По хорошему сделать для репозиториев отедьное простое хранилище
			//без reflection
			'productRepository' => [
				'class' => \app\model\repositories\ProductRepository::class
			],
			'userRepository' => [
				'class' => \app\model\repositories\UserRepository::class
			],
			'cartRepository' => [
				'class' => \app\model\repositories\CartRepository::class
			],
			'ordersRepository' => [
				'class' => \app\model\repositories\OrdersRepository::class
			],
			'orderItemRepository' => [
				'class' => \app\model\repositories\OrderItemRepository::class
			],
		]
	];