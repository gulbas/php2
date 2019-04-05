<?php

	namespace app\model\repositories;

	use app\engine\App;
	use app\model\entities\OrderItem;
	use app\model\Repository;

	class OrderItemRepository extends Repository
	{
		public function addProduct($orderId): void
		{
			foreach ($_SESSION['cart']['items'] as $item) {
				$orderItem = new OrderItem(null, $item['id'], $orderId, $item['quantity']);
				App::call()->orderItemRepository->insert($orderItem);
			}
			unset($_SESSION['cart']);
		}

		public function getTableName(): string
		{
			return 'order_item';
		}

		public function getEntityClass()
		{
			return OrderItem::class;
		}
	}