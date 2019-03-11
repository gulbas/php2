<?php

	namespace lesson2;

	abstract class Product
	{
		protected $id;
		protected $name;
		protected $price;

		public function __construct($id, $name, $price)
		{
			$this->id = $id;
			$this->name = $name;
			$this->price = $price;
		}

		public function showTotals(): void
		{
			$cost = number_format($this->finalCost(), 2, ',', ' ');
			echo "{$cost} RUB.</br>";
		}

		abstract public function finalCost();
	}

	class Piece extends Product
	{
		protected $quantity;

		public function __construct($id, $name, $price, $quantity)
		{
			parent::__construct($id, $name, $price);
			$this->quantity = $quantity;
			echo "Piece goods - <span id={$this->id}>{$this->name}</span> in the amount of {$this->quantity} sold for: ";
			$this->showTotals();
		}

		public function finalCost()
		{
			return $this->price * $this->quantity;
		}
	}

	class Digital extends Product
	{
		protected $quantity;

		public function __construct($id, $name, $price, $quantity)
		{
			parent::__construct($id, $name, $price);
			$this->quantity = $quantity;
			echo "Digital goods - <span id={$this->id}>{$this->name}</span> in the amount of {$this->quantity} sold for: ";
			$this->showTotals();
		}

		public function finalCost()
		{
			return ($this->price / 2) * $this->quantity;
		}
	}

	class Weight extends Product
	{
		protected $weightProduct;

		public function __construct($id, $name, $price, $weightProduct)
		{
			parent::__construct($id, $name, $price);
			$this->weightProduct = $weightProduct;
			echo "{$this->weightProduct} kg. {$this->name} of sold for: ";
			$this->showTotals();
		}

		public function finalCost()
		{
			return $this->price * $this->weightProduct;
		}
	}