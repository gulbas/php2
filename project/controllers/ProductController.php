<?php

	namespace app\controllers;

	use app\engine\Request;
	use app\model\Products;
	use app\model\User;

	class ProductController extends Controller
	{
		protected $number = 3;
		protected $page = 1;
		protected $loadItem = 3;
		protected $start = 0;

		public function actionIndex(): void
		{
			if ($_GET['page'] !== null) {
				$this->page = (int)$_GET['page'];
			}

			$this->number = $this->page * $this->number;
			$catalog = Products::getAll([(int)$this->start, (int)$this->number], 'category');
			++$this->page;
			$numProduct = Products::getCountTableItem() - $this->number;

			if ($numProduct < $this->loadItem) {
				$this->loadItem = $numProduct;
			}

			echo $this->render('catalog',
				['catalog' => $catalog,
				 'counter' => [
					 'numProduct' => $numProduct,
					 'pagesLeft'  => $this->page],
				 'item'    => $this->loadItem,
				 'isAdmin' => User::isAdmin()]);
		}

		public function actionPage(): void
		{
			if ($_POST['page'] !== null) {
				$this->page = (int)$_POST['page'];
			}

			$this->number = $this->page * $this->number;
			$catalog = Products::getAll([(int)$this->start, (int)$this->number], 'category');
			++$this->page;
			$numProduct = Products::getCountTableItem() - $this->number;

			if ($numProduct < $this->loadItem) {
				$this->loadItem = $numProduct;
			}

			$render = $this->render('catalog',
				['catalog' => $catalog,
				 'counter' => [
					 'numProduct' => $numProduct,
					 'pagesLeft'  => $this->page],
				 'item'    => $this->loadItem,
				 'isAdmin' => User::isAdmin()]);

			echo $render;
		}

		public function actionItem(): void
		{
			$id = (int)$_GET['id'];
			$product = Products::getOne($id);
			echo $this->render('item', ['product' => $product]);
		}

		public function actionApiCatalog(): void
		{
			$catalog = Products::getAll();
			header('Content-type: application/json');
			echo json_encode(['goods' => $catalog], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
		}

		public function actionRemove(): void
		{
			$id = (new Request())->getParams()['id'];
			$product = Products::getOneObject($id);
			$product->delete();
			header('Location: /');
		}
	}
