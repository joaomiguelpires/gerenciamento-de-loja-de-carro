<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Carros</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h2 class="mb-4">Estoque de Carros</h2>
        
        <!-- Mensagens de feedback -->
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success fade-in">
                <i class="bi bi-check-circle"></i>
                <?php 
                switch($_GET['sucesso']) {
                    case '1': echo 'Carro cadastrado com sucesso!'; break;
                    case '2': echo 'Carro atualizado com sucesso!'; break;
                    case '3': echo 'Carro excluído com sucesso!'; break;
                    default: echo 'Operação realizada com sucesso!';
                }
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger fade-in">
                <i class="bi bi-exclamation-triangle"></i>
                <?php 
                switch($_GET['erro']) {
                    case '1': echo 'Erro ao cadastrar o carro.'; break;
                    case '2': echo 'Carro não encontrado.'; break;
                    case '3': echo 'Erro ao excluir o carro.'; break;
                    default: echo 'Ocorreu um erro na operação.';
                }
                ?>
            </div>
        <?php endif; ?>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="?acao=criar" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Novo Carro
            </a>
            <form class="d-flex" method="GET">
                <input type="hidden" name="acao" value="buscar">
                <input class="form-control me-2" type="search" name="busca" placeholder="Buscar..." 
                       value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Ano</th>
                        <th>Preço</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carros as $carro): ?>
                    <tr>
                        <td><?= htmlspecialchars($carro['modelo']) ?></td>
                        <td><?= htmlspecialchars($carro['marca']) ?></td>
                        <td><?= $carro['ano_modelo'] ?></td>
                        <td>R$ <?= number_format($carro['preco_venda'], 2, ',', '.') ?></td>
                        <td>
                            <span class="badge bg-<?= $carro['status'] == 'disponivel' ? 'success' : 'danger' ?>">
                                <?= ucfirst($carro['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="?acao=editar&id=<?= $carro['id'] ?>" class="btn btn-sm btn-warning">
                                <span class="editar-content"><i class="bi bi-pencil"></i> Editar</span>
                            </a>
                            <a href="?acao=excluir&id=<?= $carro['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Tem certeza?')">
                                <i class="bi bi-trash"></i> Excluir
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>