<?php

	namespace app\controllers;

	use app\model\Products;

	class ProductController extends Controller
	{
		public function actionIndex()
		{
			if (method_exists(Products::class, 'relatedTable')) {
				$catalog = Products::getAllObjectJoin();
			} else {
				$catalog = Products::getAllObjects();
			}
			echo $this->render('catalog', ['catalog' => $catalog]);
		}

		public function actionItem()
		{
			$id = (int)$_GET['id'];
			$product = Products::getOneObject($id);
			echo $this->render('item', ['product' => $product]);
		}

	}