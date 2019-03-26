<?php

	namespace app\test;

	use app\model\Products;
	use PHPUnit\Framework\TestCase;

	class ProductTest extends TestCase
	{
		/**
		 * @dataProvider providerProduct
		 * @param $a
		 * @param $b
		 */
		public function testProduct($a, $b): void
		{
			$product = new Products(null, $a, 'aaa', 234, 3);
			$product->setName($b);
			$this->assertEquals($b, $a);
		}

		public function providerProduct(): array
		{
			return [
				['Молоко', 'Молоко'],
				['Хлеб', 'Хлеб'],
				['Кофе', 'Кофе'],
			];
		}

	}