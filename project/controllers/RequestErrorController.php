<?php

	namespace app\controllers;

	class RequestErrorController extends Controller
	{
		public function actionIndex($message)
		{
			//Вызываем метод для отображения страницы с ошибкой.
			echo $this->render('404', ['message' => $message]);
		}
	}