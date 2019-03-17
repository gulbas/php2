<?php
	/** @var \app\model\Products $product */
?>
<div class="py-3">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title"> <?= $product->name ?></h1>
        </div>
        <div class="card-body">
            <p>Категория: <?= $product->category_id ?></p>
            <p>Описание: <?= $product->description ?></p>
            <p>Количество: <?= $product->quantity ?></p>
            <p>Цена: <?= $product->price ?></p>
            <button class="btn btn-primary" id="add-product" data-id="<?= $product->id ?>">
                Добавить в корзину
            </button>
        </div>
    </div>
</div>

