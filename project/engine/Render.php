<?php

	namespace app\engine;

	class Render
	{
		public function renderTemplate($template, $params = []): string
		{
			ob_start();
			extract($params);

			$templatePath = TEMPLATE_DIR . $template . '.php';

			include $templatePath;
			return ob_get_clean();
		}

	}