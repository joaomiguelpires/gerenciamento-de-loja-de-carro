<?php
require_once __DIR__ . '/../models/ClienteModel.php';

class ClienteController {
    private $model;

    public function __construct($db) {
        $this->model = new ClienteModel($db);
    }

    public function listar() {
        try {
            $resultado = $this->model->listarClientes();
            return $resultado ?: [];
        } catch (PDOException $e) {
            error_log("Erro ao listar clientes: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            return $this->model->buscarPorId($id);
        } catch (PDOException $e) {
            error_log("Erro ao buscar cliente ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function criar($dados) {
        try {
            if (empty($dados['nome']) || empty($dados['cpf'])) {
                return [false, 'Nome e CPF são obrigatórios.'];
            }
            $resultado = $this->model->cadastrar($dados);
            if ($resultado === true) {
                return [true, null];
            } else {
                return [false, 'Erro ao inserir no banco.'];
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar cliente: " . $e->getMessage());
            return [false, $e->getMessage()];
        }
    }

    public function atualizar($id, $dados) {
        try {
            if (empty($dados['nome']) || empty($dados['cpf'])) {
                return false;
            }
            return $this->model->atualizar($id, $dados);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar cliente ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function excluir($id) {
        try {
            return $this->model->excluir($id);
        } catch (PDOException $e) {
            error_log("Erro ao excluir cliente ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function buscar($termo) {
        try {
            $filtro = [];
            if (!empty($termo)) {
                $filtro['busca'] = $termo;
            }
            return $this->model->listarClientes($filtro);
        } catch (PDOException $e) {
            error_log("Erro ao buscar clientes: " . $e->getMessage());
            return [];
        }
    }
}
?> 