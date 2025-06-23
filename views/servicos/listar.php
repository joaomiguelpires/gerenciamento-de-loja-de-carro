<style>
body { background: #e8f5e9; }
.servicos-container { max-width: 900px; margin: 30px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
h2 { color: #388e3c; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
table th, table td { padding: 10px 8px; border-bottom: 1px solid #c8e6c9; }
table th { background: #388e3c; color: #fff; }
table tr:nth-child(even) { background: #f1f8f4; }
a.btn { background: #388e3c; color: #fff; padding: 6px 16px; border-radius: 4px; text-decoration: none; margin-right: 4px; transition: background 0.2s; }
a.btn:hover { background: #2e7031; }
a.btn-danger { background: #e53935; }
a.btn-danger:hover { background: #b71c1c; }
</style>
<div class="servicos-container">
<h2>Lista de Serviços</h2>
<a href="index.php?modulo=servicos&acao=criar" class="btn">Novo Serviço</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($servicos as $servico): ?>
    <tr>
        <td><?= $servico['id'] ?></td>
        <td><?= htmlspecialchars($servico['nome']) ?></td>
        <td><?= htmlspecialchars($servico['descricao']) ?></td>
        <td><?= htmlspecialchars($servico['preco']) ?></td>
        <td>
            <a href="index.php?modulo=servicos&acao=mostrar&id=<?= $servico['id'] ?>" class="btn">Ver</a>
            <a href="index.php?modulo=servicos&acao=editar&id=<?= $servico['id'] ?>" class="btn">Editar</a>
            <a href="index.php?modulo=servicos&acao=excluir&id=<?= $servico['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div> 