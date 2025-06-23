<style>
body { background: #e8f5e9; }
.detalhes-container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
h2 { color: #388e3c; text-align: center; }
ul { list-style: none; padding: 0; }
ul li { margin-bottom: 12px; font-size: 17px; }
a.btn { background: #388e3c; color: #fff; padding: 6px 16px; border-radius: 4px; text-decoration: none; margin-right: 4px; transition: background 0.2s; }
a.btn:hover { background: #2e7031; }
</style>
<div class="detalhes-container">
<h2>Detalhes do Serviço</h2>
<ul>
    <li><strong>ID:</strong> <?= $servico['id'] ?></li>
    <li><strong>Nome:</strong> <?= htmlspecialchars($servico['nome']) ?></li>
    <li><strong>Descrição:</strong> <?= htmlspecialchars($servico['descricao']) ?></li>
    <li><strong>Preço:</strong> <?= htmlspecialchars($servico['preco']) ?></li>
</ul>
<a href="index.php?modulo=servicos&acao=editar&id=<?= $servico['id'] ?>" class="btn">Editar</a>
<a href="index.php?modulo=servicos&acao=listar" class="btn">Voltar</a>
</div> 