<?php

	namespace app\model\entities;

	class Products extends DataEntity
	{
		public $id;
		public $name;
		public $description;
		public $price;
		public $quantity;
		public $category_id;
		protected $properties = [
			'id'          => false,
			'name'        => false,
			'description' => false,
			'price'       => false,
			'quantity'    => false,
			'category_id' => false,
		];

		/**
		 * @return null
		 */
		public function getId()
		{
			return $this->id;
		}

		/**
		 * @return null
		 */
		public function getName()
		{
			return $this->name;
		}

		/**
		 * @return null
		 */
		public function getDescription()
		{
			return $this->description;
		}

		/**
		 * @return null
		 */
		public function getPrice()
		{
			return $this->price;
		}

		/**
		 * @return null
		 */
		public function getQuantity()
		{
			return $this->quantity;
		}

		/**
		 * @return null
		 */
		public function getCategoryId()
		{
			return $this->category_id;
		}

		/**
		 * @return array
		 */
		public function getProperties(): array
		{
			return $this->properties;
		}

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
	}