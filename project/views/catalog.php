<h1>Каталог</h1>
<?php
	/** @var \app\model\Products $catalog */
	foreach ($catalog as $key => $product): ?>
        <div class="card mb-5">
            <div class="card-header">
                Категория: <?= $product['category_name'] ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <a href="?c=product&a=item&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                </h5>
                <p class="card-text"><b>Описание:</b> <?= $product['description'] ?></p>
                <p class="card-text"><b>Количество:</b> <?= $product['quantity'] ?></p>
                <p class="card-text"><b>Цена:</b> <?= $product['price'] ?></p>
            </div>
        </div>
	<?php endforeach; ?>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mb-10">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>