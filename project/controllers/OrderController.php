<?php

	namespace app\controllers;

	use app\model\{Orders};

	class OrderController extends Controller
	{
		public function actionAdd(): void
		{
			Orders::addOrder();
		}

		public function actionIndex(): void
		{
			$user = $_SESSION['auth']['id'];
			$orders = Orders::getAllWhere('user_id', $user);
			echo $this->render('user/order', [
					'orders' => $orders,
				]
			);
		}

		//TODO просмотр деталей товара
	}