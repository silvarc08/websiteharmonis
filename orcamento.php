<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: php/login.php'); // Redireciona para a página de login
    exit;
}
?>

<?php
$servicos = [
    "iluminacao" => ["nome" => "Iluminação Inteligente", "preco" => 1200.00],
    "climatizacao" => ["nome" => "Climatização Automatizada", "preco" => 3500.00],
    "seguranca" => ["nome" => "Segurança e Fechaduras", "preco" => 1800.00],
    "cortinas" => ["nome" => "Cortinas Automatizadas", "preco" => 2500.00],
    "audio" => ["nome" => "Áudio Integrado", "preco" => 2200.00],
    "eletrodomesticos" => ["nome" => "Eletrodomésticos Inteligentes", "preco" => 3000.00],
    "irrigacao" => ["nome" => "Irrigação Inteligente", "preco" => 1600.00],
    "reuso" => ["nome" => "Reuso de Águas Pluviais", "preco" => 2100.00],
    "energia" => ["nome" => "Energia Solar e Eólica", "preco" => 10000.00],
    "assistente" => ["nome" => "Assistente Virtual", "preco" => 900.00],
];

$total = 0;
$selecionados = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['servicos'])) {
    foreach ($_POST['servicos'] as $chave) {
        if (isset($servicos[$chave])) {
            $total += $servicos[$chave]["preco"];
            $selecionados[] = $servicos[$chave]["nome"];
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Orçamento Automação</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/orcamento.css">
        <link rel="icon" href="img/Icone.png" type="image/png">
    </head>
    <body>
    <div class="menu-superior">
                  <div class="logo-container">
                    <img src="./img/LOGO.svg" alt="Logo" class="logo">
                  </div>
                  <div class="nav-links">
                    <a href="home.html">HOME</a>
                    <a href="sobre.html">SOBRE NÓS</a>
                    <a href="serviços.html">SERVIÇOS</a>
                    <a href="novidades.html">NOVIDADES</a>
                    <a href="fale-conosco.html">FALE CONOSCO</a>
                    <a href="orcamento.php">TÉCNICO</a>
                  </div>
            </div class ="conteudo">
        <h1>Escolha os Serviços de Automação</h1>
        <form method="POST">
            <?php foreach ($servicos as $chave => $servico): ?>
                <label>
                    <input type="checkbox" name="servicos[]" value="<?= $chave ?>">
                    <?= $servico["nome"] ?> - R$ <?= number_format($servico["preco"], 2, ',', '.') ?>
                </label>
            <br>
            <?php endforeach; ?>
            <br>
            <button type="submit">Calcular Total</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <h2>Serviços Selecionados:</h2>
            <ul>
                <?php foreach ($selecionados as $nome): ?>
                    <li><?= $nome ?></li>
                <?php endforeach; ?>
            </ul>
            <h3>Total: R$ <?= number_format($total, 2, ',', '.') ?></h3>
            
        <?php endif; ?>
        <a href="php/logout.php" class="logout-botao">Sair</a>
    </body>
</html>
