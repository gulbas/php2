<?php

	namespace app\controllers;

	use app\model\User;

	class UserController extends Controller
	{
		public function actionIndex(): void
		{
			$error = User::routeLogin();
			echo $this->render('user/main', ['error' => $error]);
		}

		public function actionHome(): void
		{
			$login = $_SESSION['auth']['login'];
			$user = User::getOneWhere('login', $login);
			echo $this->render('home',
				['user'                => $user,
				 'lastFiveVisitedPage' => $_SESSION['visited_pages']]);
		}

		public function actionRegister(): void
		{
			$error = User::register();
			echo $this->render('user/register', ['error' => $error]);
		}

		public function actionLogout(): void
		{
			unset($_SESSION['auth']);
			session_destroy();
			header('Location: /');
		}
	}