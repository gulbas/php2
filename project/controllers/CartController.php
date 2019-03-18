<?php

	namespace app\controllers;

	use app\model\{Models, Products};

	class CartController extends Controller
	{
		public function actionAddProduct()
		{
			if (isset($_POST['id'])) {
				$id = $_POST['id'];
				$quantity = $_POST['quantity'];
				if (isset($_SESSION['cart'])) {
					$exist = -1;


					foreach ($_SESSION['cart']['items'] as $index => $item) {
						if ($item['id'] == $id) {
							$exist = $index;
						}
					}

					if ($exist != -1) {
						$_SESSION['cart']['items'][$exist]['quantity'] += $quantity;
						Models::renderJson([
							'result' => 'OK',
							'status' => 'update',
							'errors' => null,
						]);
					} else {
						$_SESSION['cart']['items'][] = [
							'id'       => $id,
							'quantity' => $quantity,
						];
						Models::renderJson([
							'result' => 'OK',
							'status' => 'new',
							'errors' => null,
						]);
					}
				} else {
					// иначе просто добвляем в массив
					$_SESSION['cart']['items'][] = [
						'id'       => $id,
						'quantity' => $quantity,
					];
					Models::renderJson([
						'result' => 'OK',
						'status' => 'new',
						'errors' => null,
					]);
				}
			} else {
				Models::renderJson([
					'result' => 'ERROR',
					'errors' => [
						'Invalid POST data',
					],
				]);
			}
		}

		public function actionIndex()
		{
			$cart = [];

			if (isset($_SESSION['cart'])) {
				foreach ($_SESSION['cart']['items'] as $item) {

					$product = Products::getOne($item['id']);

					$cart[] = [
						'id'       => $item['id'],
						'name'     => $product['name'],
						'quantity' => $item['quantity'],
					];
				}
			}

			echo $this->render('cart', [
					'cart' => $cart]
			);
		}
	}