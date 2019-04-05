<?php

	namespace app\model\entities;

	class Cart
	{
		public $id;
		public $login;
		public $password;
		public $name;
		public $email;
		public $created_at;

		/**
		 * Cart constructor.
		 * @param $id
		 * @param $login
		 * @param $password
		 * @param $name
		 * @param $email
		 * @param $created_at
		 */
		public function __construct($id, $login, $password, $name, $email, $created_at)
		{
			$this->id = $id;
			$this->login = $login;
			$this->password = $password;
			$this->name = $name;
			$this->email = $email;
			$this->created_at = $created_at;
		}
	}