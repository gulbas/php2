<?php

	namespace app\controllers;

	use app\model\User;

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
			echo $this->render('admin/order');
		}
	}