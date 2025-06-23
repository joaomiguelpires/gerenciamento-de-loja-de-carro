<h2>Detalhes da Ordem de Serviço</h2>
<ul>
    <li><strong>ID:</strong> <?= $ordem['id'] ?></li>
    <li><strong>Carro:</strong> <?= htmlspecialchars($ordem['carro_modelo']) ?></li>
    <li><strong>Cliente:</strong> <?= htmlspecialchars($ordem['cliente_nome']) ?></li>
    <li><strong>Serviço:</strong> <?= htmlspecialchars($ordem['servico_nome']) ?></li>
    <li><strong>Data:</strong> <?= htmlspecialchars($ordem['data_ordem']) ?></li>
    <li><strong>Valor Total:</strong> <?= htmlspecialchars($ordem['valor_total']) ?></li>
    <li><strong>Status:</strong> <?= htmlspecialchars($ordem['status']) ?></li>
    <li><strong>Observações:</strong> <?= htmlspecialchars($ordem['observacoes']) ?></li>
</ul>
<a href="?acao=editar&id=<?= $ordem['id'] ?>">Editar</a> |
<a href="?acao=listar">Voltar</a> 