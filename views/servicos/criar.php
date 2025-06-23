<style>
body { background: #e8f5e9; }
.form-container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
h2 { color: #388e3c; text-align: center; }
form label { font-weight: 500; color: #388e3c; }
form input, form textarea { width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #c8e6c9; border-radius: 4px; }
button { background: #388e3c; color: #fff; border: none; padding: 10px 24px; border-radius: 4px; font-size: 16px; cursor: pointer; transition: background 0.2s; }
button:hover { background: #2e7031; }
</style>
<div class="form-container">
<h2>Cadastrar Serviço</h2>
<form method="post" action="index.php?modulo=servicos&acao=salvar">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br>
    <label>Descrição:</label><br>
    <textarea name="descricao"></textarea><br>
    <label>Preço:</label><br>
    <input type="number" step="0.01" name="preco" required><br>
    <button type="submit">Salvar</button>
</form>
</div> 