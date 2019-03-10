<?php

	namespace app\model;

	class Orders extends Model
	{
		public $id;
		public $session;
		public $productId;
		public $quantity;
		public $status;

		public function getTableName()
		{
			return 'orders';
		}
	}