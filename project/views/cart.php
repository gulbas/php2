<h1>Корзина</h1>
<?php if (count((array)$cart) > 0) : ?>
    <ul>
		<?php foreach ($cart as $item): ?>
            <li><?= $item['name'] ?> (количество: <?= $item['quantity'] ?>)</li>
		<?php endforeach; ?>
    </ul>
<?php else: ?>
<em>В корзине пока ничего нет</em>
<?php endif; ?>