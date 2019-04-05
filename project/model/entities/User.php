<?php

	namespace app\model\entities;

	class User extends DataEntity
	{
		public $id;
		public $login;
		public $password;
		public $name;
		public $email;
		public $created_at;

		public function __construct($id = null, $login = null, $password = null, $name = null, $email =
		null, $created_at = null)
		{
			$this->id = $id;
			$this->login = $login;
			$this->password = $password;
			$this->name = $name;
			$this->email = $email;
			$this->created_at = $created_at;
		}
	}