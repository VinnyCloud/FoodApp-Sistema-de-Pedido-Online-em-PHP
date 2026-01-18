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
    <title>Carrinho</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header class="topo">
    <h1>🛒 Carrinho</h1>
    <a href="index.php" class="btn-carrinho">⬅ Voltar</a>
</header>

<main class="container">
    <div class="card">
        <div class="card-body">

<?php if (empty($_SESSION["carrinho"])): ?>
    <p>Carrinho vazio 😢</p>
<?php else: ?>
    <?php
    $total = 0;
    foreach ($_SESSION["carrinho"] as $id => $qtd):
        $subtotal = $produtos[$id]["preco"] * $qtd;
        $total += $subtotal;
    ?>
        <p>
            <?= $produtos[$id]["nome"] ?>  
            (<?= $qtd ?>x) -  
            <strong>R$ <?= number_format($subtotal, 2, ",", ".") ?></strong>
            <a href="remover.php?id=<?= $id ?>">❌</a>
        </p>
    <?php endforeach; ?>

    <p class="total">Total: R$ <?= number_format($total, 2, ",", ".") ?></p>
    <form action="finalizar.php" method="post">
    <h3>Forma de Pagamento</h3>

    <label class="pagamento">
        <input type="radio" name="pagamento" value="Dinheiro" required>
        💵 Dinheiro
    </label>

    <label class="pagamento">
        <input type="radio" name="pagamento" value="Cartão">
        💳 Cartão
    </label>

    <label class="pagamento">
        <input type="radio" name="pagamento" value="PIX">
        📲 PIX
    </label>

    <button type="submit" class="btn-finalizar">
        Confirmar Pedido
    </button>
</form>

<?php endif; ?>

        </div>
    </div>
</main>

</body>
</html>
