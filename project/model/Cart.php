<?php

	namespace app\model;

	class Cart extends DbModel
	{
		public static $id;

		public static function addProduct(int $id, $quantity, $render): void
		{
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
						$render->renderJson([
							'result' => 'OK',
							'status' => 'update',
							'errors' => null,
						]);
					} else {
						$_SESSION['cart']['items'][] = [
							'id'       => $id,
							'quantity' => $quantity,
						];
						$render->renderJson([
							'result' => 'OK',
							'status' => 'new',
							'errors' => null,
						]);
					}
				} else {
					$_SESSION['cart']['items'][] = [
						'id'       => $id,
						'quantity' => $quantity,
					];
					$render->renderJson([
						'result' => 'OK',
						'status' => 'new',
						'errors' => null,
					]);
				}
			} else {
				$render->renderJson([
					'result' => 'ERROR',
					'errors' => [
						'Invalid POST data',
					],
				]);
			}
		}

		public static function getCart(): array
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

			return $cart;
		}

		public static function getTableName(): string
		{
			return 'cart';
		}
	}