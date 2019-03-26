<?php

	namespace app\model;

	use app\engine\Db;
	use app\interfaces\IModel;

	abstract class DbModel extends Models implements IModel
	{
/*		public function __call($name, $arguments)
		{
			return call_user_func_array($this->{$name}, $arguments);
		}*/

		public static function getOne($id)
		{
			$tableName = static::getTableName();
			$sql = "SELECT * FROM {$tableName} WHERE id = :id";
			return Db::getInstance()->queryOne($sql, [':id' => $id]);
		}

		public static function getOneObject($id)
		{
			$tableName = static::getTableName();
			$sql = "SELECT * FROM {$tableName} WHERE id = :id";
			return Db::getInstance()->queryOneObject($sql, [':id' => $id], static::class);
		}

		public static function getAll($limit = null, $join = null): array
		{
			$tableName = static::getTableName();
			$sql = "SELECT * FROM {$tableName}";

			if ($join !== null) {
				$sql = self::getAllJoin($join);
			}

			if ($limit !== null) {
				$sql .= " LIMIT {$limit[0]}, {$limit[1]}";
			}

			return Db::getInstance()->queryAll($sql);
		}

		public static function getAllObjects(): array
		{
			$tableName = static::getTableName();
			$sql = "SELECT * FROM {$tableName}";
			return Db::getInstance()->queryAllObjects($sql, [], static::class);
		}

		public static function getAllJoin($join)
		{
			$tableName = static::getTableName();
			$classVars = get_class_vars(static::class);

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
		 * @return mixed
		 */
		public function insert()
		{
			$tableName = static::getTableName();
			$params = [];
			$columns = [];

			foreach ($this as $key => $value) {
				if ($key === 'id' || $key === 'created_at') continue;
				$params[":{$key}"] = $value;
				$columns[] = $key;
			}

			$columns = implode(', ', $columns);
			$values = implode(', ', array_keys($params));

			$sql = "INSERT INTO {$tableName} ( {$columns} ) VALUES( {$values} )";
			Db::getInstance()->execute($sql, $params);
			$this->id = Db::getInstance()->getLastId();
		}

		public function delete()
		{
			$tableName = static::getTableName();
			$sql = "DELETE FROM {$tableName} WHERE id=:id";
			return Db::getInstance()->execute($sql, [':id' => $this->id]);
		}

		public function update()
		{
			$tableName = static::getTableName();
			$params = [];

			foreach ($this as $key => $value) {
				if ($key === 'id' || $key === 'created_at' || $key === 'properties') continue;
				if ($this->properties[$key] !== true) continue;
				$params[":{$key}"] = $value;
				$values[$key] = ":{$key}";
			}

			$values = array_map(function ($key, $value) {
				return "{$key}={$value}";
			}, array_keys($values), $values);

			$values = implode(', ', $values);
			$params[':id'] = $this->id;
			$sql = "UPDATE {$tableName} SET {$values} WHERE id = :id";

			return Db::getInstance()->execute($sql, $params);
		}

		public function save(): void
		{
			if ($this->id === null) {
				$this->insert();
			} else {
				$this->update();
			}
		}

		public static function getCountTableItem(): int
		{
			$tableName = static::getTableName();
			$sql = "SELECT count(*) AS count FROM {$tableName}";
			$arrayCount = Db::getInstance()->queryOne($sql);
			return (int)$arrayCount['count'];
		}

		public static function getWhere($field, $value)
		{
			$tableName = static::getTableName();
			$sql = "SELECT * FROM {$tableName} WHERE $field=:$field";
			return Db::getInstance()->queryOne($sql, [$field => $value]);
		}

		abstract public static function getTableName();
	}