<?php

	namespace app\model\entities;

	class Orders extends DataEntity
	{
		public $id;
		public $created_at;
		public $users_id;
		public $status;
		public $properties = [
			'id'         => false,
			'created_at' => false,
			'users_id'   => false,
			'status'     => false,
		];

		public function __construct($id = null, $created_at = null, $users_id = null, $status = null)
		{
			$this->id = $id;
			$this->created_at = $created_at;
			$this->users_id = $users_id;
			$this->status = $status;
		}

		public function setStatus($status): void
		{
			$this->properties['status'] = true;
			$this->status = $status;
		}

		public function getStatus()
		{
			return $this->status;
		}
	}