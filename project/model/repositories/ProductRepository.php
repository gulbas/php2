<?php

	namespace app\model\repositories;

	use app\model\entities\Products;
	use app\model\Repository;

	class ProductRepository extends Repository
	{
		public function getTableName()
		{
			return 'products';
		}

		public function getEntityClass()
		{
			return Products::class;
		}
	}