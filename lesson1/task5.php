<?php
	/**
	 * 5. Дан код:
	 * Что он выведет на каждом шаге? Почему?
	 */

	class A
	{
		public function foo()
		{
			static $x = 0;
			echo ++$x;
		}
	}

	$a1 = new A();
	$a2 = new A();
	$a1->foo(); // 1
	$a2->foo(); // 2
	$a1->foo(); // 3
	$a2->foo(); // 4

	/*
	* Значение static переменной "привязано" к классу, а не к объекту, поэтому        значение увеличивается каждый раз.
	 */