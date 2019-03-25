<?php

	namespace app\model;

	use app\engine\Render;

	class Cart extends DbModel
	{
		public static $id;

		public static function addProduct(int $id, $quantity): void
		{
			$result = [];
			if (isset($id)) {
				static::$id = $id;

				if (isset($_SESSION['cart'])) {
					$exist = -1;

					foreach ($_SESSION['cart']['items'] as $index => $item) {
						if ($item['id'] == $id) {
							$exist = $index;
						}
					}

					if ($exist != -1) {
						$_SESSION['cart']['items'][$exist]['quantity'] += $quantity;
						$result = [
							'result' => 'OK',
							'status' => 'update',
							'errors' => null,
						];
					} else {
						$_SESSION['cart']['items'][] = [
							'id'       => $id,
							'quantity' => $quantity,
						];
						$result = [
							'result' => 'OK',
							'status' => 'new',
							'errors' => null,
						];
					}
				} else {
					$_SESSION['cart']['items'][] = [
						'id'       => $id,
						'quantity' => $quantity,
					];
					$result = [
						'result' => 'OK',
						'status' => 'new',
						'errors' => null,
					];
				}
			} else {
				$result = [
					'result' => 'ERROR',
					'errors' => [
						'Invalid POST data',
					],
				];
			}
			$result += ['quantityOfGoodsInTheCart' => count($_SESSION['cart']['items'])];
			(new Render())->renderJson($result);
		}

		public static function getCart(): array
		{
			$cart = [];
			if (isset($_SESSION['cart'])) {
				foreach ($_SESSION['cart']['items'] as $key => $item) {
					$product = Products::getOne($item['id']);
					$cart[] = [
						'id'       => $item['id'],
						'name'     => $product['name'],
						'quantity' => $item['quantity'],
					];
				}
			}

			return $cart;
		}

		public static function delCartItem($id): void
		{
			foreach ($_SESSION['cart']['items'] as $key => $item) {
				if ($item['id'] === $id) {
					unset($_SESSION['cart']['items'][$key]);
				}
			}

			header('Location: /cart');
		}

		public static function getTableName(): string
		{
			return 'cart';
		}
	}