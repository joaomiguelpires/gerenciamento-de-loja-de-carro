<style>
body { background: #e3f2fd; }
.detalhes-container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
h2 { color: #1976d2; text-align: center; }
ul { list-style: none; padding: 0; }
ul li { margin-bottom: 12px; font-size: 17px; }
a.btn { background: #1976d2; color: #fff; padding: 6px 16px; border-radius: 4px; text-decoration: none; margin-right: 4px; transition: background 0.2s; }
a.btn:hover { background: #1565c0; }
</style>
<div class="detalhes-container">
<h2>Detalhes do Cliente</h2>
<ul>
    <li><strong>ID:</strong> <?= $cliente['id'] ?></li>
    <li><strong>Nome:</strong> <?= htmlspecialchars($cliente['nome']) ?></li>
    <li><strong>CPF:</strong> <?= htmlspecialchars($cliente['cpf']) ?></li>
    <li><strong>Telefone:</strong> <?= htmlspecialchars($cliente['telefone']) ?></li>
    <li><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></li>
    <li><strong>Endereço:</strong> <?= htmlspecialchars($cliente['endereco']) ?></li>
</ul>
<a href="index.php?modulo=clientes&acao=editar&id=<?= $cliente['id'] ?>" class="btn">Editar</a>
<a href="index.php?modulo=clientes&acao=listar" class="btn">Voltar</a>
</div> 