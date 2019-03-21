<?php

namespace app\controllers;

use app\model\Products;

class ProductController extends Controller
{
    protected $number = 3;
    protected $page = 1;
    protected $loadItem = 3;
    protected $start = 0;

    public function actionIndex(): void
    {
        if ($_GET['page'] !== null) {
            $this->page = (int) $_GET['page'];
        }

        $this->number = $this->page * $this->number;
        $catalog = Products::getAll([(int) $this->start, (int) $this->number], 'category');
        ++$this->page;
        $numProduct = count(Products::getAll()) - $this->number;

        if ($numProduct < $this->loadItem) {
            $this->loadItem = $numProduct;
        }

        echo $this->render('catalog',
            ['catalog' => $catalog,
                'counter' => [
                    'numProduct' => $numProduct,
                    'pagesLeft' => $this->page],
                'item' => $this->loadItem]);
    }

    public function actionPage(): void
    {
	    if ($_POST['page'] !== null) {
		    $this->page = (int) $_POST['page'];
	    }

	    $this->number = $this->page * $this->number;
	    $catalog = Products::getAll([(int) $this->start, (int) $this->number], 'category');
	    ++$this->page;
	    $numProduct = count(Products::getAll()) - $this->number;

	    if ($numProduct < $this->loadItem) {
		    $this->loadItem = $numProduct;
	    }

	    $render = $this->render('catalog',
		    ['catalog' => $catalog,
		     'counter' => [
			     'numProduct' => $numProduct,
			     'pagesLeft' => $this->page],
		     'item' => $this->loadItem]);

	    echo $render;
    }

    public function actionItem(): void
    {
        $id = (int) $_GET['id'];
        $product = Products::getOne($id);
        echo $this->render('item', ['product' => $product]);
    }
}
