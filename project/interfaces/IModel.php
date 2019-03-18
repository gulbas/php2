<?php

	namespace app\interfaces;

	interface IModel
	{
		public static function getOne($id);

		public static function getOneObject($id);

		public static function getAll();

		public static function getAllObjects();

		public static function getTableName();

	}