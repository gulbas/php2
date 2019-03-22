<?php

	namespace app\engine;

	use app\interfaces\IRenderer;
	use Twig\Environment;
	use Twig\Loader\FilesystemLoader;

	class TwigRender implements IRenderer
	{
		private $twig;

		public function __construct()
		{
			$loader = new FilesystemLoader(TWIG_DIR);
			return $this->twig = new Environment($loader);
		}

		public function renderTemplate($template, $params = []): string
		{
			return $this->twig->render($template . '.twig', $params);
		}

		public function renderJson($data): void
		{
			header('Content-type: application/json');
			echo json_encode($data);
		}
	}