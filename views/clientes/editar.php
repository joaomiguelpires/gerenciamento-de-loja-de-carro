<style>
body { background: #e3f2fd; }
.form-container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
h2 { color: #1976d2; text-align: center; }
form label { font-weight: 500; color: #1976d2; }
form input, form textarea { width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #bbdefb; border-radius: 4px; }
button { background: #1976d2; color: #fff; border: none; padding: 10px 24px; border-radius: 4px; font-size: 16px; cursor: pointer; transition: background 0.2s; }
button:hover { background: #1565c0; }
</style>
<div class="form-container">
<h2>Editar Cliente</h2>
<form method="post" action="">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?= htmlspecialchars(
        $cliente['nome'] ?? ''
    ) ?>" required><br>
    <label>CPF:</label><br>
    <input type="text" name="cpf" value="<?= htmlspecialchars(
        $cliente['cpf'] ?? ''
    ) ?>" required><br>
    <label>Telefone:</label><br>
    <input type="text" name="telefone" value="<?= htmlspecialchars(
        $cliente['telefone'] ?? ''
    ) ?>"><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars(
        $cliente['email'] ?? ''
    ) ?>"><br>
    <label>Endereço:</label><br>
    <input type="text" name="endereco" value="<?= htmlspecialchars(
        $cliente['endereco'] ?? ''
    ) ?>"><br>
    <button type="submit">Salvar</button>
</form>
</div> 