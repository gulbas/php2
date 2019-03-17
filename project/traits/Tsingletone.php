<?php

	namespace app\traits;

	trait Tsingletone
	{
		private static $instance = null;

		/**
		 * @static
		 * @return self
		 */
		public static function getInstance(): self
		{
			if (static::$instance === null) {
				static::$instance = new static();
			}
			return static::$instance;
		}

		private function __construct()
		{
		}

		private function __clone()
		{
		}

		private function __wakeup()
		{
		}
	}