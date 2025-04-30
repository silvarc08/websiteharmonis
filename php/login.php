<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario_logado'])) {
    header('Location: ../orcamento.php'); // Redireciona para a página de orçamento
    exit;
}

// Verifica o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Credenciais de login (substitua por um banco de dados em produção)
    $credenciais = [
        'admin' => '12345', // Usuário: admin, Senha: 12345
    ];

    // Verifica as credenciais
    if (isset($credenciais[$usuario]) && $credenciais[$usuario] === $senha) {
        $_SESSION['usuario_logado'] = $usuario;
        header('Location: ../orcamento.php'); // Redireciona para a página de orçamento
        exit;
    } else {
        $erro = 'Usuário ou senha inválidos!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Técnico</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <!-- Menu superior -->
    <div class="menu-superior">
                  <div class="logo-container">
                    <img src="../img/LOGO.svg" alt="Logo" class="logo">
                  </div>
                  <div class="nav-links">
                    <a href="../home.html">HOME</a>
                    <a href="../sobre.html">SOBRE NÓS</a>
                    <a href="../serviços.html">SERVIÇOS</a>
                    <a href="../novidades.html">NOVIDADES</a>
                    <a href="../fale-conosco.html">FALE CONOSCO</a>
                    <a href="/php/login.php">TÉCNICO</a>
                  </div>
            </div>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($erro)): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>
        <form method="POST">
    <input type="text" id="usuario" name="usuario" placeholder="Usuário" required>
    <input type="password" id="senha" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>