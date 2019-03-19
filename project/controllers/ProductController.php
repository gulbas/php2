<?php

	namespace app\controllers;

	use app\model\Products;

	class ProductController extends Controller
	{ 
		public static $number = 3;
		public static $page = 1; 
		public static $start;

		public function actionIndex()
		{
			// TODO доделать универсальный клас с лимитами
			

			if ($_GET['page'] !== null) {
				self::$page = (int)$_GET['page'];
			}

			self::$start = self::$page * self::$number - self::$number;
			// $catalog = Products::queryWithLimit($start, $this->number);
			

			$catalog = Products::getAll();
			//  var_dump($this->number);

			echo $this->render('catalog', ['catalog' => $catalog]);
		}

		public function actionItem()
		{
			$id = (int)$_GET['id'];
			$product = Products::getOne($id);
			echo $this->render('item', ['product' => $product]);
		}

		public static function pagination()
		{
			 return [self::$start, self::$number];
		}
	}