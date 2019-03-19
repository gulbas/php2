<?php

	namespace app\engine;

	use app\interfaces\IRenderer;
	use Twig\Environment;
	use Twig\Loader\FilesystemLoader;

	class TwigRender implements IRenderer
	{
		public function renderTemplate($template, $params = []): string
		{
			$loader = new FilesystemLoader(TWIG_DIR);
			$twig = new Environment($loader);
			return $twig->render($template . '.twig', $params);
		}
	}