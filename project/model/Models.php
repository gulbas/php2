<?php

	namespace app\model;

	class Models
	{

		public static function renderJson($data)
		{
			header('Content-type: application/json');
			echo json_encode($data);
		}

	}