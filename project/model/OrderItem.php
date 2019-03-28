<?php

	namespace app\model;

	class OrderItem extends DbModel
	{
		public $id;
		public $products_id;
		public $order_id;
		public $quantity;

		public function __construct($id = null, $products_id = null, $order_id = null, $quantity = null)
		{
			$this->id = $id;
			$this->products_id = $products_id;
			$this->order_id = $order_id;
			$this->quantity = $quantity;
		}

		public static function addProduct($orderId): void
		{
			foreach ($_SESSION['cart']['items'] as $item) {
				$orderItem = new OrderItem(null, $item['id'], $orderId, $item['quantity']);
				$orderItem->insert();
			}
			unset($_SESSION['cart']);
		}

		public static function getTableName(): string
		{
			return 'order_item';
		}
	}