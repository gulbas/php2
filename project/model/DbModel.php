<?php

	namespace app\model;

	use app\engine\Db;
	use app\interfaces\IModel;

	abstract class DbModel extends Models implements IModel
	{

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


		public static function getAll(): array
		{
			$tableName = static::getTableName();
			$sql = "SELECT * FROM {$tableName}";

			$controllerName = $_GET['c'] ?: 'product';
			$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . 'Controller';

			if (method_exists(static::class, 'relatedTable')) {
				$sql = static::getAllJoin();
		    }

			if (class_exists($controllerClass)) {
				if (method_exists($controllerClass, 'pagination')) {
					$pagination = $controllerClass::pagination();
					$sql .= " LIMIT {$pagination[0]}, {$pagination[1]}";
			   }
			}
	
			return Db::getInstance()->queryAll($sql);
		}

		public static function getAllObjects(): array
		{
			$tableName = static::getTableName();
			$sql = "SELECT * FROM {$tableName}";
			return Db::getInstance()->queryAllObjects($sql, [], static::class);
		}

		public static function getAllJoin()
		{
			$tableName = static::getTableName();
			$relatedTable = static::relatedTable();
			$classVars =  get_class_vars(static::class);
			
			foreach ($classVars as $key => $value) {
				if ($key === "{$relatedTable}_id" || $key === 'properties') continue;
				$params["{$tableName}.{$key}"] = $value;
			}
			$values = implode(', ', array_keys($params));

			$sql = "SELECT {$values}, {$relatedTable}.name AS {$relatedTable}_name 
					FROM {$tableName} JOIN {$relatedTable} 
					ON {$tableName}.{$relatedTable}_id = {$relatedTable}.id";

			return $sql;
			// return Db::getInstance()->queryAll($sql);
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
				if ($this->properties[$key] != true) continue;
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

		// public static function queryWithLimit($start, $limit)
		// {
		// 	$tableName = static::getTableName();
		// 	$sql = "SELECT * FROM {$tableName} LIMIT {$start}, {$limit}";

		// 	return Db::getInstance()->queryAll($sql);
		// }

		abstract public static function getTableName();
	}