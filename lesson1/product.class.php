<?php

	/**
	 * 1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.
	 * 2. Описать свойства класса из п.1 (состояние).
	 * 3. Описать поведение класса из п.1 (методы).
	 * 4. Придумать наследников класса из п.1. Чем они будут отличаться?
	 */

	class Product
	{
		private $id;
		private $name;
		private $price;
		private $images = [];
		private $imagesPath = './img/';

		public function __construct($id = null, $name = null, $price = null)
		{
			$this->id = $id;
			$this->name = $name;
			$this->price = $price;
			$this->getAllImagesProduct();
		}

		private function getAllImagesProduct()
		{
			$arrayImagesProduct = array_diff(scandir($this->imagesPath . $this->name, SCANDIR_SORT_NONE), ['..', '.']);

			foreach ($arrayImagesProduct as $image) {
				$this->images[] = $image;
			}
		}

		private function prepareId()
		{
			return "<p id={$this->id}>{$this->id}</p>";
		}

		private function prepareName()
		{
			return "<p>{$this->name}</p>";
		}

		private function preparePrice()
		{
			return "<p>{$this->price}</p>";
		}

		private function prepareImages()
		{
			$imageView = null;
			foreach ($this->images as $value) {
				$imageView .= "<img  alt=\"{$this->name}\" src=\"./img/{$this->name}/{$value}\"></br>";
			}
			return $imageView;
		}

		public function display()
		{
			echo $this->prepareId() . $this->prepareName() . $this->preparePrice() . $this->prepareImages();
		}
	}

	class Phone extends Product
	{
		private $rom;
		private $description;
		private $color;

		public function __construct($id = null, $name = null, $price = null, $rom = null, $description = null, $color = null)
		{
			parent::__construct($id, $name, $price);
			$this->rom = $rom;
			$this->description = $description;
			$this->color = $color;
		}

		public function display()
		{
			parent::display();
			echo $this->prepareRam() . $this->prepareDescription() . $this->prepareColor();
		}

		private function prepareRam()
		{
			return "<p>Ram: {$this->rom} Gb</p>";
		}

		private function prepareDescription()
		{
			return "<p>Описание: {$this->description}</p>";
		}

		private function prepareColor()
		{
			return "<p>Цвет: {$this->color}</p>";
		}
	}

	$product = new Product(1, 'Samsung UE55NU7670U', 20000);
	$product->display();

	$iphone = new Phone(2, 'iPhone X', 60000, 64, 'Просто ОГОНЬ', 'space grey');
	$iphone->display();