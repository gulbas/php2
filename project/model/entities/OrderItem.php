<?php

	namespace app\model\entities;

	class OrderItem extends DataEntity
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
	}