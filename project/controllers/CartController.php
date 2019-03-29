<?php

	namespace app\controllers;

	use app\engine\Request;
	use app\model\{Cart, User};
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
			Cart::addProduct($id, $quantity);
		}

		public function actionIndex(): void
		{
			$cart = Cart::getCart();
			echo $this->render('cart', [
					'cart'         => $cart,
					'isLoggedUser' => User::isLoggedUser(),
				]
			);
		}

		public function actionRemove(): void
		{
			$id = $this->request->getParams()['id'];
			Cart::delCartItem((int)$id);
		}
	}