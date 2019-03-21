<?php

	namespace app\controllers;

	use app\model\{Cart, Products};

	class CartController extends Controller
	{
		public function actionAddProduct(): void
		{
			$id = $_POST['id'];
			$quantity = $_POST['quantity'];
			Cart::addProduct($id, $quantity, $this);		
		}

		public function actionIndex(): void
		{
			$cart = Cart::getCart();
			echo $this->render('cart', [
					'cart' => $cart]
			);
		}
	}