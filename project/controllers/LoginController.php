<?php

	namespace app\controllers;

	class LoginController extends Controller
	{
		public function actionIndex(): void
		{
			// TODO ошибки авторизации
			$error = null;
			echo $this->render('login', ['error' => $error]);
		}
	}