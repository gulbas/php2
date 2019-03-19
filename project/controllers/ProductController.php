<?php

	namespace app\controllers;

	use app\model\Products;

	class ProductController extends Controller
	{
		protected $number = 3;
		protected $page = 1;
		protected $start;

		public function actionIndex(): void
		{
			if ($_GET['page'] !== null) {
				$this->page = (int)$_GET['page'];
			}
			$this->start = $this->page * $this->number - $this->number;
			$catalog = Products::getAll([$this->start, $this->number], 'category');

			echo $this->render('catalog', ['catalog' => $catalog]);
		}

		public function actionItem(): void
		{
			$id = (int)$_GET['id'];
			$product = Products::getOne($id);
			echo $this->render('item', ['product' => $product]);
		}
	}