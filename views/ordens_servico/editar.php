<h2>Editar Ordem de Serviço</h2>
<form method="post" action="">
    <label>Carro:</label><br>
    <select name="carro_id" required>
        <?php foreach ($carros as $carro): ?>
            <option value="<?= $carro['id'] ?>" <?= ($ordem['carro_id'] == $carro['id']) ? 'selected' : '' ?>> <?= htmlspecialchars($carro['modelo']) ?> </option>
        <?php endforeach; ?>
    </select><br>
    <label>Cliente:</label><br>
    <select name="cliente_id" required>
        <?php foreach ($clientes as $cliente): ?>
            <option value="<?= $cliente['id'] ?>" <?= ($ordem['cliente_id'] == $cliente['id']) ? 'selected' : '' ?>> <?= htmlspecialchars($cliente['nome']) ?> </option>
        <?php endforeach; ?>
    </select><br>
    <label>Serviço:</label><br>
    <select name="servico_id" required>
        <?php foreach ($servicos as $servico): ?>
            <option value="<?= $servico['id'] ?>" <?= ($ordem['servico_id'] == $servico['id']) ? 'selected' : '' ?>> <?= htmlspecialchars($servico['nome']) ?> </option>
        <?php endforeach; ?>
    </select><br>
    <label>Data da Ordem:</label><br>
    <input type="date" name="data_ordem" value="<?= htmlspecialchars($ordem['data_ordem']) ?>" required><br>
    <label>Valor Total:</label><br>
    <input type="number" step="0.01" name="valor_total" value="<?= htmlspecialchars($ordem['valor_total']) ?>" required><br>
    <label>Status:</label><br>
    <select name="status">
        <option value="aberta" <?= ($ordem['status'] == 'aberta') ? 'selected' : '' ?>>Aberta</option>
        <option value="em_andamento" <?= ($ordem['status'] == 'em_andamento') ? 'selected' : '' ?>>Em Andamento</option>
        <option value="finalizada" <?= ($ordem['status'] == 'finalizada') ? 'selected' : '' ?>>Finalizada</option>
        <option value="cancelada" <?= ($ordem['status'] == 'cancelada') ? 'selected' : '' ?>>Cancelada</option>
    </select><br>
    <label>Observações:</label><br>
    <textarea name="observacoes"><?= htmlspecialchars($ordem['observacoes']) ?></textarea><br>
    <button type="submit">Salvar</button>
</form> 