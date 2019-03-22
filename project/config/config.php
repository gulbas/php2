<?php

	define('DS', DIRECTORY_SEPARATOR);
	define('TEMPLATE_DIR', '../views/');
	define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
	define('TWIG_DIR', TEMPLATE_DIR . 'twig/');

	session_start();