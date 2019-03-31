<?php

	namespace app\controllers;

	use app\engine\App;

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
			$catalog = App::call()->productRepository->getAll([(int)$this->start, (int)$this->number], 'category');
			++$this->page;
			$numProduct = App::call()->productRepository->getCountTableItem() - $this->number;

			if ($numProduct < $this->loadItem) {
				$this->loadItem = $numProduct;
			}

			echo $this->render('catalog',
				['catalog' => $catalog,
				 'counter' => [
					 'numProduct' => $numProduct,
					 'pagesLeft'  => $this->page],
				 'item'    => $this->loadItem,
				 'isAdmin' => App::call()->userRepository->isAdmin()]);
		}

		public function actionPage(): void
		{
			if ($_POST['page'] !== null) {
				$this->page = (int)$_POST['page'];
			}

			$this->number = $this->page * $this->number;
			$catalog = App::call()->productRepository->getAll([(int)$this->start, (int)$this->number], 'category');
			++$this->page;
			$numProduct = App::call()->productRepository->getCountTableItem() - $this->number;

			if ($numProduct < $this->loadItem) {
				$this->loadItem = $numProduct;
			}

			$render = $this->render('catalog',
				['catalog' => $catalog,
				 'counter' => [
					 'numProduct' => $numProduct,
					 'pagesLeft'  => $this->page],
				 'item'    => $this->loadItem,
				 'isAdmin' => App::call()->userRepository->isAdmin()]);

			echo $render;
		}

		public function actionItem(): void
		{
			$id = (int)$_GET['id'];
			echo $this->render('item', ['product' => App::call()->productRepository->getOne($id)]);
		}

		public function actionApiCatalog(): void
		{
			$catalog = App::call()->productRepository->getAll();
			header('Content-type: application/json');
			echo json_encode(['goods' => $catalog], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
		}

		public function actionRemove(): void
		{
			$id = App::call()->request->getParams()['id'];
			App::call()->productRepository->delete($id);
			header('Location: /');
		}
	}
