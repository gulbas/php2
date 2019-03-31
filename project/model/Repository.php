<?php

	namespace app\model;

	use app\model\entities\DataEntity;
	use app\engine\App;

	abstract class Repository
	{
		protected $db;

		public function __construct()
		{
			$this->db = App::call()->db;
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
			return $this->db->queryOneObject($sql, [':id' => $id], $this->getEntityClass());
		}

		public function getAll($limit = null, $join = null): array
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$tableName}";

			if ($join !== null) {
				$sql = $this->getAllJoin($join);
			}

			if ($limit !== null) {
				$sql .= " LIMIT {$limit[0]}, {$limit[1]}";
			}

			return $this->db->queryAll($sql);
		}

		public function getAllObjects(): array
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$tableName}";
			return $this->db->queryAllObjects($sql, [], $this->getEntityClass());
		}

		public function getAllJoin($join)
		{
			$tableName = $this->getTableName();

			$classVars = get_class_vars($this->getEntityClass());

			foreach ($classVars as $key => $value) {
				if ($key === "{$join}_id" || $key === 'properties') continue;
				$params["{$tableName}.{$key}"] = $value;
			}
			$values = implode(', ', array_keys($params));

			$sql = "SELECT {$values}, {$join}.name AS {$join}_name 
					FROM {$tableName} JOIN {$join} 
					ON {$tableName}.{$join}_id = {$join}.id";


			return $sql;
		}

		/**
		 * @param DataEntity $entity
		 * @return mixed
		 */
		public function insert(DataEntity $entity)
		{
			$tableName = $this->getTableName();
			$params = [];
			$columns = [];

			foreach ($entity as $key => $value) {
				if ($key === 'id' || $key === 'created_at' || $key === 'properties') continue;
				$params[":{$key}"] = $value;
				$columns[] = $key;
			}

			$columns = implode(', ', $columns);
			$values = implode(', ', array_keys($params));

			$sql = "INSERT INTO {$tableName} ( {$columns} ) VALUES( {$values} )";
			$this->db->execute($sql, $params);
			return $this->id = $this->db->getLastId();
		}

		public function delete($id)
		{
			$tableName = $this->getTableName();
			$sql = "DELETE FROM {$tableName} WHERE id=:id";
			return $this->db->execute($sql, [':id' => $id]);
		}

		public function update($entity)
		{
			$tableName = $this->getTableName();
			$params = [];

			foreach ($entity as $key => $value) {
				if ($key === 'id' || $key === 'created_at' || $key === 'properties') continue;
				if ($entity->properties[$key] !== true) continue;

				$params[":{$key}"] = $value;
				$values[$key] = ":{$key}";
			}


			$values = array_map(function ($key, $value) {
				return "{$key}={$value}";
			}, array_keys($values), $values);

			$values = implode(', ', $values);
			$params[':id'] = $entity->id;
			$sql = "UPDATE {$tableName} SET {$values} WHERE id = :id";

			return $this->db->execute($sql, $params);
		}

		public function save(DataEntity $entity): void
		{
			if ($this->id === null) {
				$this->insert($entity);
			} else {
				$this->update($entity);
			}
		}

		public function getCountTableItem(): int
		{
			$tableName = $this->getTableName();
			$sql = "SELECT count(*) AS count FROM {$tableName}";
			$arrayCount = $this->db->queryOne($sql);
			return (int)$arrayCount['count'];
		}

		public function getOneWhere($field, $value)
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$tableName} WHERE $field=:$field";
			return $this->db->queryOne($sql, [$field => $value]);
		}

		public function getAllWhere($field, $value)
		{
			$tableName = $this->getTableName();
			$sql = "SELECT * FROM {$tableName} WHERE $field=:$field";
			return $this->db->queryAll($sql, [$field => $value]);
		}

		abstract public function getTableName();

		abstract public function getEntityClass();
	}