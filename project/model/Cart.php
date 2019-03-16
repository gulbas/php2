<?php

	namespace app\model;

	class Cart extends Model
	{
		public $id;
		public $id_order;

		public function getTableName()
		{
			return 'cart';
		}
	}