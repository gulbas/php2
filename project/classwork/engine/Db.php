<?php

	namespace app\engine;


	use app\traits\Tsingletone;

	class Db
	{
		use Tsingletone;

		private $config = [
			'drive'    => 'mysql',
			'host'     => 'localhost',
			'login'    => 'root',
			'password' => '',
			'database' => 'shop',
			'charset'  => 'utf8',
		];

		private $connection = null;

		private function getConnection()
		{
			if ($this->connection === null) {
				$this->connection = new \PDO($this->prepareDSNstr(),
					$this->config['login'],
					$this->config['password']
				);
				var_dump('Подключение к БД');
				$this->connection->setAttribute(
					\PDO::ATTR_DEFAULT_FETCH_MODE,
					\PDO::FETCH_ASSOC);
			}
			return $this->connection;
		}

		private function prepareDSNstr()
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

		public function queryOne($sql, $param = [])
		{
			return $this->queryAll($sql, $param)[0];
		}

		public function queryAll($sql, $param = []): array
		{
			return $this->query($sql, $param)->fetchAll();
		}
	}