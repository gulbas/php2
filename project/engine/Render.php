<?php

	namespace app\engine;

	use app\interfaces\{IRenderer, IRenderJson};

	class Render implements IRenderer, IRenderJson
	{
		public function renderTemplate($template, $params = []): string
		{
			ob_start();
			extract($params);

			$templatePath = TEMPLATE_DIR . $template . '.php';

			include $templatePath;
			return ob_get_clean();
		}

		public function renderJson($data): void
		{
			header('Content-type: application/json');
			echo json_encode($data);
		}

	}