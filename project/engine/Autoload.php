<?php

	namespace app\engine;

	class Autoload
	{
		public function loadClass($className): void
		{
			$fileName = str_replace(['app\\', '\\'], [DIR_ROOT . '/../', DS], $className) . '.php';
			if (file_exists($fileName)) {
				include $fileName;
			}
			var_dump($fileName);
		}
	}