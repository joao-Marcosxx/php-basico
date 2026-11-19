<?php
// Configurações de conexão com o PostgreSQL
$host = 'localhost';
$port = '5432';
$dbname = 'projeto_crud';
$user = 'postgres';
$password = 'postgres'; 

$tarefas = [];
$erro = null;

try {
    // 1. Conectar ao banco projeto_crud com PDO
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // 2. Buscar todas as tarefas, ordenadas pelo id
    $stmt = $pdo->query("SELECT id, titulo, descricao, status FROM tarefas ORDER BY id ASC");
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // 5. Exibir mensagem de erro amigável sem quebrar a página
    $erro = "Erro ao conectar ou buscar dados no banco: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .erro { color: #b00020; background: #fdecea; padding: 10px; border: 1px solid #f5c2c7; max-width: 800px; }
    </style>
</head>
<body>

    <h1>Lista de Tarefas</h1>

    <?php if ($erro): ?>
        <!-- Mensagem de erro caso a conexão falhe -->
        <p class="erro"><?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <!-- 3. Tabela HTML com as colunas solicitadas -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($tarefas) > 0): ?>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <tr>
                            <!-- 4. Escapando cada valor com htmlspecialchars() -->
                            <td><?= htmlspecialchars((string)$tarefa['id']) ?></td>
                            <td><?= htmlspecialchars($tarefa['titulo']) ?></td>
                            <td><?= htmlspecialchars($tarefa['descricao'] ?? '') ?></td>
                            <td><?= htmlspecialchars($tarefa['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhuma tarefa cadastrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
