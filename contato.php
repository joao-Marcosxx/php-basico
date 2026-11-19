<?php
$nome = '';
$mensagem = '';
$enviado = false;

// Verifica se a requisição atual foi feita via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados da superglobal $_POST e remove espaços extras nas pontas
    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    $enviado = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
</head>
<body>

    <h1>Formulário de Contato</h1>

    <!-- action="" ou omitido envia para a própria página -->
    <form method="POST" action="">
        <div>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required>
        </div>
        <br>
        <div>
            <label for="mensagem">Mensagem:</label><br>
            <textarea id="mensagem" name="mensagem" rows="5" cols="40" required></textarea>
        </div>
        <br>
        <button type="submit">Enviar</button>
    </form>

    <?php if ($enviado): ?>
        <hr>
        <h2>Dados Recebidos:</h2>
        <!-- htmlspecialchars() converte caracteres especiais em entidades HTML, prevenindo XSS -->
        <p><strong>Nome:</strong> <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Mensagem:</strong><br><?= nl2br(htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8')) ?></p>
    <?php endif; ?>

</body>
</html>
