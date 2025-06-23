<h2>Cadastrar Ordem de Serviço</h2>
<form method="post" action="index.php?modulo=ordens_servico&acao=salvar">
    <label>Carro:</label><br>
    <select name="carro_id" required>
        <?php foreach ($carros as $carro): ?>
            <option value="<?= $carro['id'] ?>"> <?= htmlspecialchars($carro['modelo']) ?> </option>
        <?php endforeach; ?>
    </select><br>
    <label>Cliente:</label><br>
    <select name="cliente_id" required>
        <?php foreach ($clientes as $cliente): ?>
            <option value="<?= $cliente['id'] ?>"> <?= htmlspecialchars($cliente['nome']) ?> </option>
        <?php endforeach; ?>
    </select><br>
    <label>Serviço:</label><br>
    <select name="servico_id" required>
        <?php foreach ($servicos as $servico): ?>
            <option value="<?= $servico['id'] ?>"> <?= htmlspecialchars($servico['nome']) ?> </option>
        <?php endforeach; ?>
    </select><br>
    <label>Data da Ordem:</label><br>
    <input type="date" name="data_ordem" required><br>
    <label>Valor Total:</label><br>
    <input type="number" step="0.01" name="valor_total" required><br>
    <label>Status:</label><br>
    <select name="status">
        <option value="aberta">Aberta</option>
        <option value="em_andamento">Em Andamento</option>
        <option value="finalizada">Finalizada</option>
        <option value="cancelada">Cancelada</option>
    </select><br>
    <label>Observações:</label><br>
    <textarea name="observacoes"></textarea><br>
    <button type="submit">Salvar</button>
</form> 