<?php

	namespace app\controllers;

	use app\interfaces\IRenderer;
	use app\model\User;
	use app\model\Visited;

	class Controller implements IRenderer
	{
		private $action;
		private const DEFAULT_ACTION = 'index';
		private $layout = 'main';
		private $useLayout = true;
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
			Visited::visitedPage();
			$quantityOfGoodsInTheCart = $_SESSION['cart']['items'];
			if ($quantityOfGoodsInTheCart === null || count($_SESSION['cart']['items']) === 0) {
				$quantityOfGoodsInTheCart = null;
			} else {
				$quantityOfGoodsInTheCart = count($_SESSION['cart']['items']);
			}

			if ($this->useLayout) {
				return $this->renderTemplate("layouts/{$this->layout}",
					['content'      => $this->renderTemplate($template, $params),
					 'count'        => $quantityOfGoodsInTheCart,
					 'isLoggedUser' => User::isLoggedUser(),
					 'isAdmin'      => User::isAdmin()]);
			}
			return $this->renderTemplate($template, $params);
		}

		public function renderTemplate($template, $params = []): string
		{
			return $this->renderer->renderTemplate($template, $params);
		}

		public function renderJson($data)
		{
			return $this->renderer->renderJson($data);
		}
	}