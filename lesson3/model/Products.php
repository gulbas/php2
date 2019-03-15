<?php

	namespace app\model;

	class Products extends Model
	{
		public $id;
		public $name;
		public $description;
		public $price;
		public $quantity;
		public $category_id;

		public function __construct($id = null, $name = null, $description = null, $price = null, $quantity =
		null, $category_id = null)
		{
			parent::__construct();
			$this->id = $id;
			$this->name = $name;
			$this->description = $description;
			$this->price = $price;
			$this->quantity = $quantity;
			$this->category_id = $category_id;
		}

		public function getTableName(): string
		{
			return 'products';
		}
	}

