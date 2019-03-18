<?php

	namespace app\controllers;

	class Controller
	{
		private $action;
		private const DEFAULT_ACTION = 'index';
		private $layout = 'main';
		private $useLayout = true;

		public function runAction($action = null)
		{
			$this->action = $action ?: self::DEFAULT_ACTION;

			$method = 'action' . ucfirst($this->action);

			if (method_exists($this, $method)) {
				$this->$method();
			} else {
				echo '404';
			}
		}

		public function render($template, $params = [])
		{
			if ($this->useLayout) {
				return $this->renderTemplate("layouts/{$this->layout}",
					['content' => $this->renderTemplate($template, $params)]);
			}
			return $this->renderTemplate($template, $params);
		}

		public function renderTemplate($template, $params = [])
		{
			ob_start();
			extract($params);
			$templatePath = TEMPLATE_DIR . $template . '.php';
			include $templatePath;
			return ob_get_clean();
		}
	}