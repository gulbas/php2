<?php

	namespace app\engine;

	use app\traits\Tsingletone;

	class Db
	{
		use Tsingletone;

		static public $chosenToStringMethod;

		private $config = [
			'drive'    => 'mysql',
			'host'     => 'localhost',
			'login'    => 'root',
			'password' => '',
			'database' => 'shop',
			'charset'  => 'utf8',
		];

		private $connection = null;

		private function getConnection(): ?\PDO
		{
			if ($this->connection === null) {
				$this->connection = new \PDO(
					$this->prepareDsnStr(),
					$this->config['login'],
					$this->config['password']
				);
				$this->connection->setAttribute(
					\PDO::ATTR_DEFAULT_FETCH_MODE,
					\PDO::FETCH_ASSOC);
			}
			return $this->connection;
		}

		private function prepareDsnStr(): string
		{
			return sprintf('%s:host=%s;dbname=%s;charset=%s',
				$this->config['drive'],
				$this->config['host'],
				$this->config['database'],
				$this->config['charset']);
		}

		private function query($sql, $param)
		{
			$pdoStatement = $this->getConnection()->prepare($sql);
			$pdoStatement->execute($param);
			return $pdoStatement;
		}

		public function execute($sql, $param): bool
		{
			$this->query($sql, $param);
			return true;
		}

		public function getLastId(): int
		{
			return $this->connection->lastInsertId();
		}

		public function queryOne($sql, $param = [])
		{
			return $this->queryAll($sql, $param)[0];
		}

		public function queryAll($sql, $param = []): array
		{
			return $this->query($sql, $param)->fetchAll();
		}

		public function queryOneObject($sql, $param = [], $class)
		{
			$sth = $this->query($sql, $param);
			$sth->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
			$obj = $sth->fetch();
			$obj->info = function () {
				echo 'hi';
			};
			return $obj;
		}

		public function queryAllObjects($sql, $param = [], $class): array
		{
			$sth = $this->query($sql, $param);
			$sth->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
			return $sth->fetchAll();
		}

		public function __toString()
		{
			return 'Db';
		}
	}