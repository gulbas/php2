<?php

	namespace app\controllers;

	use app\engine\App;
	use app\engine\Request;
	use app\interfaces\IRenderer;

	class CartController extends Controller
	{
		private $request;

		public function __construct(IRenderer $renderer)
		{
			parent::__construct($renderer);
			$this->request = new Request();
		}

		public function actionAddProduct(): void
		{
			$id = $this->request->getParams()['id'];
			$quantity = $this->request->getParams()['quantity'];
			App::call()->cartRepository->addProduct($id, $quantity);
		}

		public function actionIndex(): void
		{
			$cart = App::call()->cartRepository->getCart();
			echo $this->render('cart', [
					'cart'         => $cart,
					'isLoggedUser' => App::call()->userRepository->isLoggedUser(),
				]
			);
		}

		public function actionRemove(): void
		{
			$id = $this->request->getParams()['id'];
			App::call()->cartRepository->delCartItem((int)$id);
		}
	}