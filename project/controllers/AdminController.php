<?php

	namespace app\controllers;

	class AdminController extends Controller
	{
		public function actionIndex(): void
		{
			echo $this->render('admin/main');
		}
	}