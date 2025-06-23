<?php
require_once __DIR__ . '/../models/OrdemServicoModel.php';

class OrdemServicoController {
    private $model;

    public function __construct($db) {
        $this->model = new OrdemServicoModel($db);
    }

    public function listar() {
        try {
            $resultado = $this->model->listarOrdens();
            return $resultado ?: [];
        } catch (PDOException $e) {
            error_log("Erro ao listar ordens de serviço: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            return $this->model->buscarPorId($id);
        } catch (PDOException $e) {
            error_log("Erro ao buscar ordem de serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function criar($dados) {
        try {
            if (empty($dados['carro_id']) || empty($dados['cliente_id']) || empty($dados['servico_id']) || empty($dados['data_ordem']) || empty($dados['valor_total'])) {
                return false;
            }
            $dados['status'] = $dados['status'] ?? 'aberta';
            $dados['observacoes'] = $dados['observacoes'] ?? '';
            return $this->model->cadastrar($dados);
        } catch (PDOException $e) {
            error_log("Erro ao criar ordem de serviço: " . $e->getMessage());
            return false;
        }
    }

    public function atualizar($id, $dados) {
        try {
            if (empty($dados['carro_id']) || empty($dados['cliente_id']) || empty($dados['servico_id']) || empty($dados['data_ordem']) || empty($dados['valor_total'])) {
                return false;
            }
            return $this->model->atualizar($id, $dados);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar ordem de serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function excluir($id) {
        try {
            return $this->model->excluir($id);
        } catch (PDOException $e) {
            error_log("Erro ao excluir ordem de serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function buscar($termo) {
        try {
            $filtro = [];
            if (!empty($termo)) {
                $filtro['busca'] = $termo;
            }
            return $this->model->listarOrdens($filtro);
        } catch (PDOException $e) {
            error_log("Erro ao buscar ordens de serviço: " . $e->getMessage());
            return [];
        }
    }
}
?> 