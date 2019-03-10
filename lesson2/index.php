<?php

	use lesson2\Digital;
	use lesson2\Piece;
	use lesson2\Weight;

	include __DIR__ . '/Product.php';

	$piece = new Piece(1, 'table', 15000, 10);
	$digital = new Digital(2, 'book', 500, 4);
	$weight = new Weight(3, 'bananas', 300, 0.5);
