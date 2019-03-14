<?php

	namespace app\model;

	use app\engine\Db;
	use app\interfaces\IModel;

	abstract class Model implements IModel
	{
		protected $db;

		public function __construct()
		{
			$this->db = Db::getInstance();
		}

		public function getOne($id)
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$tableName} WHERE id = :id";
			return $this->db->queryOne($sql, [':id' => $id]);
		}

		public function getOneObject($id)
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$tableName} WHERE id = :id";
			return $this->db->queryOneObject($sql, [':id' => $id], static::class);
		}


		public function getAll(): array
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$tableName}";
			return $this->db->queryAll($sql);
		}

		public function getAllObjects(): array
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$tableName}";
			return $this->db->queryAllObjects($sql, [], static::class);
		}

		public function insert()
		{
			$tableName = $this->getTableName();
			$arrayObjectValue = [];
			$strValue = null;
			$strTable = null;

			// танцы с бубном связаны с тем, что есть ряд параметров в объекте которые в бд передавать не нужно,
			// например created_at. О том, что существует вставка объектов на прямую, если названия свойств
			// совпадают с именами параметров знаю
			$objVars = get_object_vars($this);
			foreach ($objVars as $key => $value) {
				if ($key !== 'db' && $key !== 'created_at') {
					$arrayObjectValue[':' . $key] = $value;
					$strValue .= ":{$key}, ";
					$strTable .= "{$key}, ";
				}
			}

			$strValue = substr($strValue, 0, -2);
			$strTable = substr($strTable, 0, -2);

			$sql = "INSERT INTO {$tableName} ( {$strTable} ) VALUES( {$strValue} )";

			return $this->db->execute($sql, $arrayObjectValue);
		}

		public function delete()
		{
			$tableName = $this->getTableName();
			$sql = "DELETE FROM {$tableName} WHERE id=:id";
			if ($this->id == null) {
				$this->id = $this->db->getLastId();
			}
			return $this->db->execute($sql, [':id' => $this->id]);
		}

		public function update()
		{
			$tableName = $this->getTableName();
			$arrayObjectValue = [];
			$strValue = null;

			// танцы с бубном связаны с тем, что есть ряд параметров в объекте которые в бд передавать не нужно,
			// например created_at. О том, что существует вставка объектов на прямую, если названия свойств
			// совпадают с именами параметров знаю
			$objVars = get_object_vars($this);
			foreach ($objVars as $key => $value) {
				if ($key !== 'db' && $key !== 'created_at' && $key !== 'id') {
					$strValue .= "{$key}=:{$key}, ";
					$arrayObjectValue[':' . $key] = $value;
				}
			}

			if ($this->id == null) {
				$this->id = $this->db->getLastId();
			}

			$arrayObjectValue['id'] = $this->id;

			$strValue = substr($strValue, 0, -2);

			$sql = "UPDATE {$tableName} SET ( {$strValue} ) WHERE id = :id";

		return $this->db->execute($sql, $arrayObjectValue);
		}

		abstract public function getTableName();
	}
