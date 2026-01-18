<?php
session_start();

/* PRODUTOS */
$produtos = [
    1 => ["nome" => "Hambúrguer Artesanal", "preco" => 25],
    2 => ["nome" => "Pizza Calabresa", "preco" => 40],
    3 => ["nome" => "Hot Dog Especial", "preco" => 15],
    4 => ["nome" => "Batata Frita", "preco" => 12],
];

/* DADOS DO PEDIDO */
$pagamento = $_POST["pagamento"] ?? "Não informado";
$pedido = rand(10000, 99999);
$data = date("d/m/Y H:i");
$total = 0;

/* =========================
   TEXTO DO RECIBO WHATSAPP
   ========================= */
$mensagem  = "🧾 *RECIBO DO PEDIDO*%0A";
$mensagem .= "Pedido Nº: $pedido%0A";
$mensagem .= "Data: $data%0A";
$mensagem .= "Pagamento: $pagamento%0A%0A";
$mensagem .= "*Itens:*%0A";

if (!empty($_SESSION["carrinho"])) {
    foreach ($_SESSION["carrinho"] as $id => $qtd) {
        $subtotal = $produtos[$id]["preco"] * $qtd;
        $total += $subtotal;
        $mensagem .= "- {$produtos[$id]['nome']} ({$qtd}x) - R$ "
                   . number_format($subtotal, 2, ",", ".") . "%0A";
    }
}

$mensagem .= "%0A*Total:* R$ " . number_format($total, 2, ",", ".") . "%0A";
$mensagem .= "%0AObrigado pelo pedido 🍔";

/* NÚMERO DO WHATSAPP (MUDE AQUI) */
$whatsapp = "5514991158577"; // EXEMPLO: 55 + DDD + NÚMERO
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recibo do Pedido</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header class="topo">
    <h1>🧾 Recibo do Pedido</h1>
</header>

<main class="container">
    <div class="card recibo">
        <div class="card-body">

            <h2>FoodApp</h2>
            <p><strong>Pedido Nº:</strong> <?= $pedido ?></p>
            <p><strong>Data:</strong> <?= $data ?></p>
            <p><strong>Pagamento:</strong> <?= $pagamento ?></p>

            <hr>

            <table width="100%">
                <tr>
                    <th align="left">Item</th>
                    <th>Qtd</th>
                    <th align="right">Subtotal</th>
                </tr>

                <?php if (!empty($_SESSION["carrinho"])): ?>
                    <?php foreach ($_SESSION["carrinho"] as $id => $qtd): 
                        $subtotal = $produtos[$id]["preco"] * $qtd;
                    ?>
                    <tr>
                        <td><?= $produtos[$id]["nome"] ?></td>
                        <td align="center"><?= $qtd ?></td>
                        <td align="right">R$ <?= number_format($subtotal, 2, ",", ".") ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>

            <hr>

            <h3>Total: R$ <?= number_format($total, 2, ",", ".") ?></h3>

            <?php if ($pagamento == "PIX"): ?>
                <p><strong>Chave PIX:</strong> foodapp@pix.com</p>
            <?php endif; ?>

            <button onclick="window.print()" class="btn-finalizar">
                🖨️ Imprimir Recibo
            </button>

            <!-- BOTÃO WHATSAPP -->
            <a
                href="https://wa.me/<?= $whatsapp ?>?text=<?= $mensagem ?>"
                target="_blank"
                class="btn-whatsapp"
            >
                📲 Enviar recibo no WhatsApp
            </a>

            <a href="index.php" class="btn-carrinho" style="display:block;margin-top:10px;text-align:center;">
                Novo Pedido
            </a>

        </div>
    </div>
</main>

</body>
</html>

<?php
session_destroy();
?>
