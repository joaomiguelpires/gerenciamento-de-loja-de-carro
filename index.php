<?php
session_start();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/CarroController.php';
require_once __DIR__ . '/controllers/ClienteController.php';
require_once __DIR__ . '/controllers/ServicoController.php';
require_once __DIR__ . '/controllers/OrdemServicoController.php';

// Verifica autenticação
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}

// Conexão com o banco
$database = new Database();
$db = $database->getConnection();

// Instancia os Controllers
$carroController = new CarroController($db);
$clienteController = new ClienteController($db);
$servicoController = new ServicoController($db);
$ordemServicoController = new OrdemServicoController($db);

// Menu de navegação
function renderMenu($entidade) {
    echo '<nav style="margin-bottom:20px;">';
    echo '<a href="?modulo=carros"' . ($entidade=="carros"?' style="font-weight:bold;"':'') . '>Carros</a> | ';
    echo '<a href="?modulo=clientes"' . ($entidade=="clientes"?' style="font-weight:bold;"':'') . '>Clientes</a> | ';
    echo '<a href="?modulo=servicos"' . ($entidade=="servicos"?' style="font-weight:bold;"':'') . '>Serviços</a> | ';
    echo '<a href="?modulo=ordens_servico"' . ($entidade=="ordens_servico"?' style="font-weight:bold;"':'') . '>Ordens de Serviço</a> | ';
    echo '<a href="logout.php">Sair</a>';
    echo '</nav>';
}

$modulo = isset($_GET['modulo']) ? $_GET['modulo'] : 'carros';
$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';

switch ($modulo) {
    case 'clientes':
        renderMenu('clientes');
        switch ($acao) {
            case 'listar':
            default:
                $clientes = $clienteController->listar();
                include __DIR__ . '/views/clientes/listar.php';
                break;
            case 'criar':
                include __DIR__ . '/views/clientes/criar.php';
                break;
            case 'salvar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    list($ok, $msg) = $clienteController->criar($_POST);
                    if ($ok) {
                        header("Location: index.php?modulo=clientes&acao=listar&sucesso=1");
                    } else {
                        header("Location: index.php?modulo=clientes&acao=criar&erro=1&msg=" . urlencode($msg));
                    }
                    exit();
                }
                break;
            case 'editar':
                $id = $_GET['id'] ?? 0;
                $cliente = $clienteController->buscarPorId($id);
                if ($cliente) {
                    include __DIR__ . '/views/clientes/editar.php';
                } else {
                    header("Location: index.php?modulo=clientes&acao=listar&erro=2");
                    exit();
                }
                break;
            case 'atualizar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = $_POST['id'] ?? 0;
                    $resultado = $clienteController->atualizar($id, $_POST);
                    header("Location: index.php?modulo=clientes&acao=listar" . ($resultado ? '&sucesso=2' : '&erro=1'));
                    exit();
                }
                break;
            case 'excluir':
                $id = $_GET['id'] ?? 0;
                $resultado = $clienteController->excluir($id);
                header("Location: index.php?modulo=clientes&acao=listar" . ($resultado ? '&sucesso=3' : '&erro=3'));
                exit();
                break;
            case 'mostrar':
                $id = $_GET['id'] ?? 0;
                $cliente = $clienteController->buscarPorId($id);
                include __DIR__ . '/views/clientes/mostrar.php';
                break;
            case 'buscar':
                $busca = $_GET['busca'] ?? '';
                $clientes = $clienteController->buscar($busca);
                include __DIR__ . '/views/clientes/listar.php';
                break;
        }
        break;
    case 'servicos':
        renderMenu('servicos');
        switch ($acao) {
            case 'listar':
            default:
                $servicos = $servicoController->listar();
                include __DIR__ . '/views/servicos/listar.php';
                break;
            case 'criar':
                include __DIR__ . '/views/servicos/criar.php';
                break;
            case 'salvar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $resultado = $servicoController->criar($_POST);
                    header("Location: index.php?modulo=servicos&acao=listar" . ($resultado ? '&sucesso=1' : '&erro=1'));
                    exit();
                }
                break;
            case 'editar':
                $id = $_GET['id'] ?? 0;
                $servico = $servicoController->buscarPorId($id);
                if ($servico) {
                    include __DIR__ . '/views/servicos/editar.php';
                } else {
                    header("Location: index.php?modulo=servicos&acao=listar&erro=2");
                    exit();
                }
                break;
            case 'atualizar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = $_POST['id'] ?? 0;
                    $resultado = $servicoController->atualizar($id, $_POST);
                    header("Location: index.php?modulo=servicos&acao=listar" . ($resultado ? '&sucesso=2' : '&erro=1'));
                    exit();
                }
                break;
            case 'excluir':
                $id = $_GET['id'] ?? 0;
                $resultado = $servicoController->excluir($id);
                header("Location: index.php?modulo=servicos&acao=listar" . ($resultado ? '&sucesso=3' : '&erro=3'));
                exit();
                break;
            case 'mostrar':
                $id = $_GET['id'] ?? 0;
                $servico = $servicoController->buscarPorId($id);
                include __DIR__ . '/views/servicos/mostrar.php';
                break;
            case 'buscar':
                $busca = $_GET['busca'] ?? '';
                $servicos = $servicoController->buscar($busca);
                include __DIR__ . '/views/servicos/listar.php';
                break;
        }
        break;
    case 'ordens_servico':
        renderMenu('ordens_servico');
        switch ($acao) {
            case 'listar':
            default:
                $ordens = $ordemServicoController->listar();
                include __DIR__ . '/views/ordens_servico/listar.php';
                break;
            case 'criar':
                // Carregar dados para selects
                $carros = $carroController->listar();
                $clientes = $clienteController->listar();
                $servicos = $servicoController->listar();
                include __DIR__ . '/views/ordens_servico/criar.php';
                break;
            case 'salvar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $resultado = $ordemServicoController->criar($_POST);
                    header("Location: index.php?modulo=ordens_servico&acao=listar" . ($resultado ? '&sucesso=1' : '&erro=1'));
                    exit();
                }
                break;
            case 'editar':
                $id = $_GET['id'] ?? 0;
                $ordem = $ordemServicoController->buscarPorId($id);
                $carros = $carroController->listar();
                $clientes = $clienteController->listar();
                $servicos = $servicoController->listar();
                if ($ordem) {
                    include __DIR__ . '/views/ordens_servico/editar.php';
                } else {
                    header("Location: index.php?modulo=ordens_servico&acao=listar&erro=2");
                    exit();
                }
                break;
            case 'atualizar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = $_POST['id'] ?? 0;
                    $resultado = $ordemServicoController->atualizar($id, $_POST);
                    header("Location: index.php?modulo=ordens_servico&acao=listar" . ($resultado ? '&sucesso=2' : '&erro=1'));
                    exit();
                }
                break;
            case 'excluir':
                $id = $_GET['id'] ?? 0;
                $resultado = $ordemServicoController->excluir($id);
                header("Location: index.php?modulo=ordens_servico&acao=listar" . ($resultado ? '&sucesso=3' : '&erro=3'));
                exit();
                break;
            case 'mostrar':
                $id = $_GET['id'] ?? 0;
                $ordem = $ordemServicoController->buscarPorId($id);
                include __DIR__ . '/views/ordens_servico/mostrar.php';
                break;
            case 'buscar':
                $busca = $_GET['busca'] ?? '';
                $ordens = $ordemServicoController->buscar($busca);
                include __DIR__ . '/views/ordens_servico/listar.php';
                break;
        }
        break;
    case 'carros':
    default:
        renderMenu('carros');
        switch ($acao) {
            case 'listar':
            default:
                $carros = $carroController->listar();
                include __DIR__ . '/views/carros/listar.php';
                break;
            case 'criar':
                include __DIR__ . '/views/carros/criar.php';
                break;
            case 'salvar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $resultado = $carroController->criar($_POST);
                    header("Location: index.php?modulo=carros&acao=listar" . ($resultado ? '&sucesso=1' : '&erro=1'));
                    exit();
                }
                break;
            case 'editar':
                $id = $_GET['id'] ?? 0;
                $carro = $carroController->buscarPorId($id);
                if ($carro) {
                    include __DIR__ . '/views/carros/editar.php';
                } else {
                    header("Location: index.php?modulo=carros&acao=listar&erro=2");
                    exit();
                }
                break;
            case 'atualizar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = $_POST['id'] ?? 0;
                    $resultado = $carroController->atualizar($id, $_POST);
                    header("Location: index.php?modulo=carros&acao=listar" . ($resultado ? '&sucesso=2' : '&erro=1'));
                    exit();
                }
                break;
            case 'excluir':
                $id = $_GET['id'] ?? 0;
                $resultado = $carroController->excluir($id);
                header("Location: index.php?modulo=carros&acao=listar" . ($resultado ? '&sucesso=3' : '&erro=3'));
                exit();
                break;
            case 'mostrar':
                $id = $_GET['id'] ?? 0;
                $carro = $carroController->buscarPorId($id);
                include __DIR__ . '/views/carros/mostrar.php';
                break;
            case 'buscar':
                $busca = $_GET['busca'] ?? '';
                $carros = $carroController->buscar($busca);
                include __DIR__ . '/views/carros/listar.php';
                break;
        }
        break;
}
?>