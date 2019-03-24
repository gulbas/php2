<?php

	namespace app\model;

	class Visited
	{
		public static function visitedPage(): void
		{
			if (!isset($_SESSION['visited_pages'])) {
				$_SESSION['visited_pages'] = [];
			}
			$_SESSION['visited_pages'][] = [$_SERVER["REQUEST_URI"]];
			if (count($_SESSION['visited_pages']) > 5) array_shift($_SESSION['visited_pages']);
		}
	}