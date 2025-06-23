<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="mb-4 text-primary text-center">Cadastrar Cliente</h2>
                    <?php if (isset($_GET['erro'])): ?>
                        <div class="alert alert-danger">
                            Erro ao salvar cliente. <?php if (isset($_GET['msg'])) echo htmlspecialchars($_GET['msg']); ?>
                        </div>
                    <?php elseif (isset($_GET['sucesso'])): ?>
                        <div class="alert alert-success">Cliente cadastrado com sucesso!</div>
                    <?php endif; ?>
                    <form method="post" action="index.php?modulo=clientes&acao=salvar">
                        <div class="mb-3">
                            <label class="form-label">Nome:</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CPF:</label>
                            <input type="text" name="cpf" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefone:</label>
                            <input type="text" name="telefone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Endereço:</label>
                            <input type="text" name="endereco" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 