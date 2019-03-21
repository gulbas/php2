<?php

	namespace app\controllers;

	use app\interfaces\IRenderer;

	class Controller implements IRenderer
	{
		private $action;
		private const DEFAULT_ACTION = 'index';
		private $layout = 'main';
		private $useLayout = false; // If the Twig is on, be sure to turn off this option.
		private $renderer;

		public function __construct(IRenderer $renderer)
		{
			$this->renderer = $renderer;
		}

		public function runAction($action = null): void
		{
			$this->action = $action ?: self::DEFAULT_ACTION;

			$method = 'action' . ucfirst($this->action);

			if (method_exists($this, $method)) {
				$this->$method();
			} else {
				echo '404';
			}
		}

		public function render($template, $params = []): string
		{
			if ($this->useLayout) {
				return $this->renderTemplate("layouts/{$this->layout}",
					['content' => $this->renderTemplate($template, $params)]);
			}
			return $this->renderTemplate($template, $params);
		}

		public function renderTemplate($template, $params = []): string
		{
			return $this->renderer->renderTemplate($template, $params);
		}

		public function renderJson($data): string
		{
			return $this->renderer->renderJson($data);
		}
	}