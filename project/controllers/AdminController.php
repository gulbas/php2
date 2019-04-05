<?php

	namespace app\controllers;

	use app\engine\App;
	use app\engine\Request;

	class AdminController extends Controller
	{
		public function actionIndex(): void
		{
			if (!App::call()->userRepository->isAdmin()) {
				header('Location: /');
			}
			echo $this->render('admin/main');
		}

		public function actionOrder(): void
		{
			if (!App::call()->userRepository->isAdmin()) {
				header('Location: /');
			}
			$id = (new Request)->getParams()['change'];
			if ($id) {
				App::call()->ordersRepository->change($id);
			}
			echo $this->render('admin/order', ['orders' => App::call()->ordersRepository->getAll(null, 'users')]);
		}
	}