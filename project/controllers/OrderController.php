<?php
namespace app\controllers;


use app\model\{Orders};

class OrderController extends Controller 
{
    public function actionAdd(): void
    {
        Orders::addOrder();
        
		}
}