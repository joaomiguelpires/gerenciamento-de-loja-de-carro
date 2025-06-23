<?php
// Verifica se o usuário está logado
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: ../../login.php");
    exit();
}

// Conexão com o banco
$database = new Database();
$db = $database->getConnection();

// Instancia o Controller
$controller = new CarroController($db);

// Processa o formulário se for POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($controller->atualizar($_POST['id'], $_POST)) {
        header("Location: index.php?modulo=carros&acao=listar&sucesso=2");
        exit();
    }
    $erro = "Erro ao atualizar o carro";
}

// Busca o carro para edição
$carro = $controller->buscarPorId($_GET['id']);
if (!$carro) {
    header("Location: listar.php");
    exit();
}
?>

<style>
body { background: #e3eafc; }
.form-container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
h2 { color: #1a237e; text-align: center; }
form label { font-weight: 500; color: #1a237e; }
form input, form select, form textarea { width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #90caf9; border-radius: 4px; }
button, a.btn { background: #1a237e; color: #fff; border: none; padding: 10px 24px; border-radius: 4px; font-size: 16px; cursor: pointer; text-decoration: none; margin-right: 8px; transition: background 0.2s; }
button:hover, a.btn:hover { background: #0d133d; }
</style>
<div class="form-container">
    <h2>Editar Carro</h2>
    <?php if (isset($erro)): ?>
        <div style="color: #fff; background: #e53935; padding: 10px; border-radius: 4px; margin-bottom: 16px; text-align:center;"> <?= $erro ?> </div>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $carro['id'] ?>">
        <label>Modelo</label>
        <input type="text" name="modelo" value="<?= htmlspecialchars($carro['modelo']) ?>" required>
        <label>Marca</label>
        <input type="text" name="marca" value="<?= htmlspecialchars($carro['marca']) ?>" required>
        <label>Ano Fabricação</label>
        <input type="number" name="ano_fabricacao" value="<?= $carro['ano_fabricacao'] ?>" required>
        <label>Placa</label>
        <input type="text" name="placa" value="<?= htmlspecialchars($carro['placa']) ?>" required>
        <label>Preço de Venda</label>
        <input type="number" step="0.01" name="preco_venda" value="<?= $carro['preco_venda'] ?>" required>
        <label>Status</label>
        <select name="status" required>
            <option value="disponivel" <?= $carro['status'] == 'disponivel' ? 'selected' : '' ?>>Disponível</option>
            <option value="reservado" <?= $carro['status'] == 'reservado' ? 'selected' : '' ?>>Reservado</option>
            <option value="vendido" <?= $carro['status'] == 'vendido' ? 'selected' : '' ?>>Vendido</option>
        </select>
        <label>Observações</label>
        <textarea name="observacoes" rows="3"><?= htmlspecialchars($carro['observacoes']) ?></textarea>
        <button type="submit">Salvar Alterações</button>
        <a href="index.php?modulo=carros&acao=listar" class="btn">Cancelar</a>
    </form>
</div>

