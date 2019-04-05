<?php

	namespace app\controllers;

	use app\engine\App;

	class UserController extends Controller
	{
		public function actionIndex(): void
		{
			$error = App::call()->userRepository->routeLogin();
			echo $this->render('user/main', ['error' => $error]);
		}

		public function actionHome(): void
		{
			$login = $_SESSION['auth']['login'];
			$user = App::call()->userRepository->getOneWhere('login', $login);
			echo $this->render('home',
				['user'                => $user,
				 'lastFiveVisitedPage' => $_SESSION['visited_pages']]);
		}

		public function actionRegister(): void
		{
			$error = App::call()->userRepository->register();
			echo $this->render('user/register', ['error' => $error]);
		}

		public function actionLogout(): void
		{
			unset($_SESSION['auth']);
			session_destroy();
			header('Location: /');
		}
	}