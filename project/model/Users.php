<?php

	namespace app\model;

	class Users extends Model
	{
		public $id = null;
		public $login;
		public $password;
		public $name;
		public $email;
		public $created_at = null;

		public function __construct($id = null, $login = null, $password = null, $name = null, $email =
		null, $created_at = null)
		{
			parent::__construct();
			$this->id = $id;
			$this->login = $login;
			$this->password = $password;
			$this->name = $name;
			$this->email = $email;
			$this->created_at = $created_at;
		}

		public function getTableName()
		{
			return 'users';
		}
	}