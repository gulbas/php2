<?php

	namespace app\model;

	use app\engine\Db;
	use app\interfaces\IModel;

	abstract class Model implements IModel
	{
		protected $db;

		public function __construct(Db $db)
		{
			$this->db = $db;
		}

		public function getOne($id): array
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
			return $this->db->queryOne($sql);
		}

		public function getAll(): array
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$this->tableName}";
			return $this->db->queryAll($sql);
		}

		abstract public function getTableName();
	}