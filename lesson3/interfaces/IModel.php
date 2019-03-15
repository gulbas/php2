<?php

	namespace app\interfaces;

	interface IModel
	{
		public function getOne($id);

		public function getOneObject($id);

		public function getAll();

		public function getAllObjects();

		public function getTableName();

	}