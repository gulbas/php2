<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/logo.png">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="/img/logo.png" alt="Geekbrains PHP 1" height="30" class="mr-2">
        Geekbrains PHP 2 </a>
    <div class="collapse navbar-collapse navbar-right" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/?c=cart">Корзина</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
	<?= $content ?>
</div>
<?php $c = $_GET['c'];
	if ($c === 'product'): ?>
        <script
                src="http://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
        <script src="/js/product.js" defer></script>
	<?php endif; ?>
</body>
</html>