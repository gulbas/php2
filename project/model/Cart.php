<?php

	namespace app\model;

	class Cart extends DbModel
	{
		public $id;
		public $id_order;

		public static function getTableName(): string
		{
			return 'cart';
		}
	}