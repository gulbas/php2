<?php

	class Autoload
	{
		public function loadClass($className): void
		{
			$nameSpace = __NAMESPACE__ . '\\' . $className;
			$path = str_replace(['\\', '/app/'], ['/', '/../'], $nameSpace);
			$fileName = __DIR__ . $path . '.php';
			var_dump($fileName);

			include $fileName;
		}
	}