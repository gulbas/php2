<?php

	namespace app\controllers;

	use app\model\{Orders, User};
	use app\engine\Request;

	class OrderController extends Controller
	{
		public function actionAdd(): void
		{
			if (!User::isLoggedUser()) {
				header('Location: /');
			} else {
				Orders::addOrder();
			}
		}

		public function actionIndex(): void
		{
			if (!User::isLoggedUser()) {
				header('Location: /');
			} else {
				$user = $_SESSION['auth']['id'];
				$orders = Orders::getAllWhere('users_id', $user);
				echo $this->render('user/order', [
					'orders' => $orders,
				]);
			}
		}

		public function actionView(): void
		{
			if (!User::isLoggedUser()) {
				header('Location: /');
			} else {
				$id = (new Request)->getParams()['id'];
				$orders = Orders::view($id);
				echo $this->render('user/orderView', [
					'orders' => $orders, 'orderId' => $id,
				]);
			}
		}
	}
