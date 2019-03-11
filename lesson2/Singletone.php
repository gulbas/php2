<?php

	trait oneTrait
	{
		public function deleteRow($id): void
		{
			echo "DELETE * FROM title WHERE id = {$id}";
		}
	}

	class Singleton
	{
		private static $single;

		public function __construct(){}

		public function __clone(){}

		public function __wakeup(){}

		public function getSingle(): Singleton
		{
			if (self::$single === null) {
				self::$single = new Singleton();
				return self::$single;
			}
			return self::$single;
		}

		use oneTrait;
	}

	Singleton::getSingle()->deleteRow(1);
	/*	// Check
		$o = new Singleton();
	*/

