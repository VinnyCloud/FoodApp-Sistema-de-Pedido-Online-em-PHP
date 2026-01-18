<?php
session_start();

$produtos = [
    1 => ["nome" => "Hambúrguer Artesanal", "preco" => 25],
    2 => ["nome" => "Pizza Calabresa", "preco" => 40],
    3 => ["nome" => "Hot Dog Especial", "preco" => 15],
    4 => ["nome" => "Batata Frita", "preco" => 12],
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>FoodApp</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header class="topo">
    <h1>🍔 FoodApp</h1>
    <a href="carrinho.php" class="btn-carrinho">🛒 Carrinho</a>
</header>

<main class="container">
<?php foreach ($produtos as $id => $produto): ?>
    <div class="card">
        <div class="card-body">
            <h3><?= $produto["nome"] ?></h3>
            <p class="preco">R$ <?= number_format($produto["preco"], 2, ",", ".") ?></p>
            <form action="adicionar.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button class="btn-add">Adicionar</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>
</main>

</body>
</html>
