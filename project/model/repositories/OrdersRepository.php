<?php

	namespace app\model\repositories;

	use app\engine\App;
	use app\model\entities\Orders;
	use app\model\Repository;

	class OrdersRepository extends Repository
	{
		public function addOrder(): void
		{
			if (!App::call()->userRepository->isLoggedUser()) {
				header('Location: /');
			} else {
				$userID = $_SESSION['auth']['id'];
				if (isset($_SESSION['cart'])) {

					$order = new Orders(null, null, $userID, 0);
					$lastId = App::call()->ordersRepository->insert($order);


					if ($lastId > 0) {
						App::call()->orderItemRepository->addProduct($lastId);
					}
				}
				header('Location: /');
			}
		}

		public function view($id): array
		{
			$orders = [];
			if (isset($id)) {
				$order = App::call()->orderItemRepository->getAllWhere('order_id', $id);
				$products = App::call()->productRepository->getAll();

				foreach ($order as $item) {
					foreach ($products as $product) {
						if ($item['products_id'] === $product['id']) {
							$item['products_id'] = $product['name'];
						}
					}
					$orders[] = $item;
				}
			}
			return $orders;
		}

		public function change($id): void
		{
			$order = $this->getOneObject($id);
			if ($order->getStatus() === '0') {
				$order->setStatus(1);
			} else {
				$order->setStatus(0);
			}
			$this->update($order);
		}

		public function getTableName()
		{
			return 'orders';
		}

		public function getEntityClass()
		{
			return Orders::class;
		}
	}
