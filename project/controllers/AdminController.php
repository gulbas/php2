<?php

	namespace app\controllers;

	use app\model\{User, Orders};
	use app\engine\Request;

	class AdminController extends Controller
	{
		public function actionIndex(): void
		{
			if (!User::isAdmin()) {
				header('Location: /');
			}
			echo $this->render('admin/main');
		}

		public function actionOrder(): void
		{
			if (!User::isAdmin()) {
				header('Location: /');
			}
			$id = (new Request)->getParams()['change'];
			if ($id) {
				Orders::change($id);
			}
			echo $this->render('admin/order', ['orders' => Orders::getAll(null, 'users')]);
		}
	}