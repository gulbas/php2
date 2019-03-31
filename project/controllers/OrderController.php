<?php

	namespace app\controllers;

	use app\engine\App;
	use app\engine\Request;

	class OrderController extends Controller
	{
		public function actionAdd(): void
		{
			if (!App::call()->userRepository->isLoggedUser()) {
				header('Location: /');
			} else {
				App::call()->ordersRepository->addOrder();
			}
		}

		public function actionIndex(): void
		{
			if (!App::call()->userRepository->isLoggedUser()) {
				header('Location: /');
			} else {
				$user = $_SESSION['auth']['id'];
				$orders = App::call()->ordersRepository->getAllWhere('users_id', $user);
				echo $this->render('user/order', [
					'orders' => $orders,
				]);
			}
		}

		public function actionView(): void
		{
			if (!App::call()->userRepository->isLoggedUser()) {
				header('Location: /');
			} else {
				$id = (new Request)->getParams()['id'];
				$orders = App::call()->ordersRepository->view($id);
				echo $this->render('user/orderView', [
					'orders' => $orders, 'orderId' => $id,
				]);
			}
		}
	}
