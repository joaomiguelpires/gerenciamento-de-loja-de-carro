<?php
require_once __DIR__ . '/../models/ServicoModel.php';

class ServicoController {
    private $model;

    public function __construct($db) {
        $this->model = new ServicoModel($db);
    }

    public function listar() {
        try {
            $resultado = $this->model->listarServicos();
            return $resultado ?: [];
        } catch (PDOException $e) {
            error_log("Erro ao listar serviços: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            return $this->model->buscarPorId($id);
        } catch (PDOException $e) {
            error_log("Erro ao buscar serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function criar($dados) {
        try {
            if (empty($dados['nome']) || empty($dados['preco'])) {
                return false;
            }
            return $this->model->cadastrar($dados);
        } catch (PDOException $e) {
            error_log("Erro ao criar serviço: " . $e->getMessage());
            return false;
        }
    }

    public function atualizar($id, $dados) {
        try {
            if (empty($dados['nome']) || empty($dados['preco'])) {
                return false;
            }
            return $this->model->atualizar($id, $dados);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function excluir($id) {
        try {
            return $this->model->excluir($id);
        } catch (PDOException $e) {
            error_log("Erro ao excluir serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function buscar($termo) {
        try {
            $filtro = [];
            if (!empty($termo)) {
                $filtro['busca'] = $termo;
            }
            return $this->model->listarServicos($filtro);
        } catch (PDOException $e) {
            error_log("Erro ao buscar serviços: " . $e->getMessage());
            return [];
        }
    }
}
?> 