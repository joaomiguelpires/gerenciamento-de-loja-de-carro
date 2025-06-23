<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Carro - Loja de Carros</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Loja de Carros</a>
            <div class="navbar-nav">
                <a class="nav-link" href="?acao=listar">Carros</a>
                <a class="nav-link" href="logout.php">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="bi bi-plus-circle"></i> Novo Carro
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['erro'])): ?>
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                                Erro ao cadastrar o carro. Verifique os dados e tente novamente.
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="?acao=salvar">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="modelo" class="form-label">Modelo *</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="marca" class="form-label">Marca *</label>
                                    <input type="text" class="form-control" id="marca" name="marca" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="ano_fabricacao" class="form-label">Ano de Fabricação</label>
                                    <input type="number" class="form-control" id="ano_fabricacao" name="ano_fabricacao" 
                                           min="1900" max="<?= date('Y') + 1 ?>" value="<?= date('Y') ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="ano_modelo" class="form-label">Ano do Modelo</label>
                                    <input type="number" class="form-control" id="ano_modelo" name="ano_modelo" 
                                           min="1900" max="<?= date('Y') + 1 ?>" value="<?= date('Y') ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="cor" class="form-label">Cor</label>
                                    <input type="text" class="form-control" id="cor" name="cor">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="placa" class="form-label">Placa</label>
                                    <input type="text" class="form-control" id="placa" name="placa" 
                                           placeholder="ABC-1234" maxlength="8">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="chassi" class="form-label">Chassi</label>
                                    <input type="text" class="form-control" id="chassi" name="chassi" 
                                           maxlength="17" placeholder="17 caracteres">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="km" class="form-label">Quilometragem</label>
                                    <input type="number" class="form-control" id="km" name="km" 
                                           min="0" value="0">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="preco_compra" class="form-label">Preço de Compra</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="number" class="form-control" id="preco_compra" name="preco_compra" 
                                               min="0" step="0.01" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="preco_venda" class="form-label">Preço de Venda</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="number" class="form-control" id="preco_venda" name="preco_venda" 
                                               min="0" step="0.01" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="disponivel">Disponível</option>
                                    <option value="vendido">Vendido</option>
                                    <option value="reservado">Reservado</option>
                                    <option value="manutencao">Em Manutenção</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="?acao=listar" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Voltar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Salvar Carro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>