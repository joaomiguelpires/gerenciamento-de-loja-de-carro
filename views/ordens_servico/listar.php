<style>
body { background: #fff3e0; }
.ordens-container { max-width: 1000px; margin: 30px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
h2 { color: #f57c00; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
table th, table td { padding: 10px 8px; border-bottom: 1px solid #ffe0b2; }
table th { background: #f57c00; color: #fff; }
table tr:nth-child(even) { background: #fff8e1; }
a.btn { background: #f57c00; color: #fff; padding: 6px 16px; border-radius: 4px; text-decoration: none; margin-right: 4px; transition: background 0.2s; }
a.btn:hover { background: #e65100; }
a.btn-danger { background: #e53935; }
a.btn-danger:hover { background: #b71c1c; }
</style>
<div class="ordens-container">
<h2>Lista de Ordens de Serviço</h2>
<a href="index.php?modulo=ordens_servico&acao=criar" class="btn">Nova Ordem de Serviço</a>
<table>
    <tr>
        <th>ID</th>
        <th>Carro</th>
        <th>Cliente</th>
        <th>Serviço</th>
        <th>Data</th>
        <th>Valor Total</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($ordens as $ordem): ?>
    <tr>
        <td><?= $ordem['id'] ?></td>
        <td><?= htmlspecialchars($ordem['carro_modelo']) ?></td>
        <td><?= htmlspecialchars($ordem['cliente_nome']) ?></td>
        <td><?= htmlspecialchars($ordem['servico_nome']) ?></td>
        <td><?= htmlspecialchars($ordem['data_ordem']) ?></td>
        <td><?= htmlspecialchars($ordem['valor_total']) ?></td>
        <td><?= htmlspecialchars($ordem['status']) ?></td>
        <td>
            <a href="index.php?modulo=ordens_servico&acao=mostrar&id=<?= $ordem['id'] ?>" class="btn">Ver</a>
            <a href="index.php?modulo=ordens_servico&acao=editar&id=<?= $ordem['id'] ?>" class="btn">Editar</a>
            <a href="index.php?modulo=ordens_servico&acao=excluir&id=<?= $ordem['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div> 