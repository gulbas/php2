<?php

	namespace app\model;

	class Products extends DbModel
	{
		protected $id;
		protected $name;
		protected $description;
		protected $price;
		protected $quantity;
		protected $category_id;
		protected $properties = [
			'id'          => false,
			'name'        => false,
			'description' => false,
			'price'       => false,
			'quantity'    => false,
			'category_id' => false,
		];

		public function setName($name): void
		{
			$this->properties['name'] = true;
			$this->name = $name;
		}

		public function setDescription($description): void
		{
			$this->properties['description'] = true;
			$this->description = $description;
		}

		public function setPrice($price): void
		{
			$this->properties['price'] = true;
			$this->price = $price;
		}

		public function setQuantity($quantity): void
		{
			$this->properties['quantity'] = true;
			$this->quantity = $quantity;
		}

		public function setCategoryId($category_id): void
		{
			$this->properties['category_id'] = true;
			$this->category_id = $category_id;
		}

		public function __construct($id = null, $name = null, $description = null, $price = null, $quantity =
		null, $category_id = null)
		{
			$this->id = $id;
			$this->name = $name;
			$this->description = $description;
			$this->price = $price;
			$this->quantity = $quantity;
			$this->category_id = $category_id;
		}

		public static function getTableName(): string
		{
			return 'products';
		}
	}