<?php

	namespace app\model;

	class Orders extends Model
	{
		public $id;
		public $status;
		public $user_id;
		public $product_id;
		public $quantity;

		/**
		 * Orders constructor.
		 * @param $id {int} id order
		 * @param $status {int} status order
		 * @param $user_id {int} user id
		 * @param $product_id {int} product id
		 * @param $quantity {int} quantity
		 */
		public function __construct($id = null, $status = null, $user_id = null, $product_id = null, $quantity = null)
		{
			parent::__construct();
			$this->id = $id;
			$this->status = $status;
			$this->user_id = $user_id;
			$this->product_id = $product_id;
			$this->quantity = $quantity;
		}

		public function getTableName()
		{
			return 'orders';
		}
	}