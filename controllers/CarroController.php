<?php
require_once __DIR__ . '/../models/CarroModel.php';

class CarroController {
    private $model;

    public function __construct($db) {
        $this->model = new CarroModel($db);
    }

    // Método listar que estava faltando
    public function listar() {
        try {
            $resultado = $this->model->listarCarros();
            
            if(empty($resultado)) {
                return [];
            }
            
            return $resultado;
        } catch (PDOException $e) {
            // Log do erro
            error_log("Erro ao listar carros: " . $e->getMessage());
            return [];
        }
    }

    // Buscar carro por ID
    public function buscarPorId($id) {
        try {
            return $this->model->buscarPorId($id);
        } catch (PDOException $e) {
            error_log("Erro ao buscar carro ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    // Criar novo carro
    public function criar($dados) {
        try {
            // Validação básica
            if (empty($dados['modelo']) || empty($dados['marca'])) {
                return false;
            }

            // Dados padrão se não fornecidos
            $dados['status'] = $dados['status'] ?? 'disponivel';
            $dados['ano_fabricacao'] = $dados['ano_fabricacao'] ?? date('Y');
            $dados['ano_modelo'] = $dados['ano_modelo'] ?? date('Y');
            $dados['km'] = $dados['km'] ?? 0;
            $dados['preco_compra'] = $dados['preco_compra'] ?? 0;
            $dados['preco_venda'] = $dados['preco_venda'] ?? 0;

            return $this->model->cadastrar($dados);
        } catch (PDOException $e) {
            error_log("Erro ao criar carro: " . $e->getMessage());
            return false;
        }
    }

    // Atualizar carro existente
    public function atualizar($id, $dados) {
        try {
            // Validação básica
            if (empty($dados['modelo']) || empty($dados['marca'])) {
                return false;
            }

            return $this->model->atualizar($id, $dados);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar carro ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    // Excluir carro
    public function excluir($id) {
        try {
            return $this->model->excluir($id);
        } catch (PDOException $e) {
            error_log("Erro ao excluir carro ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    // Buscar carros com filtro
    public function buscar($termo) {
        try {
            $filtro = [];
            if (!empty($termo)) {
                $filtro['busca'] = $termo;
            }
            return $this->model->listarCarros($filtro);
        } catch (PDOException $e) {
            error_log("Erro ao buscar carros: " . $e->getMessage());
            return [];
        }
    }
}
?>