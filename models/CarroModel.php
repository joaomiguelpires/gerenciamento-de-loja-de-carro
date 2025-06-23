<?php
class CarroModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Listar todos os carros (com filtro opcional)
    public function listarCarros($filtro = []) {
        try {
            $query = "SELECT id, modelo, marca, ano_fabricacao, ano_modelo, cor, placa, chassi, km, preco_compra, preco_venda, status FROM carros WHERE 1=1";
            $params = [];

            // Filtros dinâmicos
            if (!empty($filtro['busca'])) {
                $query .= " AND (modelo LIKE :busca OR marca LIKE :busca OR placa LIKE :busca)";
                $params[':busca'] = "%{$filtro['busca']}%";
            }
            if (!empty($filtro['status'])) {
                $query .= " AND status = :status";
                $params[':status'] = $filtro['status'];
            }
            $query .= " ORDER BY modelo ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar carros: " . $e->getMessage());
            return [];
        }
    }

    // Buscar carro por ID
    public function buscarPorId($id) {
        try {
            $query = "SELECT * FROM carros WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar carro ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    // Cadastrar novo carro
    public function cadastrar($dados) {
        try {
            $query = "INSERT INTO carros (
                modelo, marca, ano_fabricacao, ano_modelo, cor, placa, chassi, km, 
                preco_compra, preco_venda, status
            ) VALUES (
                :modelo, :marca, :ano_fabricacao, :ano_modelo, :cor, :placa, :chassi, :km,
                :preco_compra, :preco_venda, :status
            )";

            $stmt = $this->conn->prepare($query);
            
            // Bind dos parâmetros
            $stmt->bindParam(':modelo', $dados['modelo']);
            $stmt->bindParam(':marca', $dados['marca']);
            $stmt->bindParam(':ano_fabricacao', $dados['ano_fabricacao'], PDO::PARAM_INT);
            $stmt->bindParam(':ano_modelo', $dados['ano_modelo'], PDO::PARAM_INT);
            $stmt->bindParam(':cor', $dados['cor']);
            $stmt->bindParam(':placa', $dados['placa']);
            $stmt->bindParam(':chassi', $dados['chassi']);
            $stmt->bindParam(':km', $dados['km'], PDO::PARAM_INT);
            $stmt->bindParam(':preco_compra', $dados['preco_compra']);
            $stmt->bindParam(':preco_venda', $dados['preco_venda']);
            $stmt->bindParam(':status', $dados['status']);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar carro: " . $e->getMessage());
            return false;
        }
    }

    // Atualizar carro existente
    public function atualizar($id, $dados) {
        try {
            $query = "UPDATE carros SET
                modelo = :modelo,
                marca = :marca,
                ano_fabricacao = :ano_fabricacao,
                ano_modelo = :ano_modelo,
                cor = :cor,
                placa = :placa,
                chassi = :chassi,
                km = :km,
                preco_compra = :preco_compra,
                preco_venda = :preco_venda,
                status = :status
                WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            
            // Bind dos parâmetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':modelo', $dados['modelo']);
            $stmt->bindParam(':marca', $dados['marca']);
            $stmt->bindParam(':ano_fabricacao', $dados['ano_fabricacao'], PDO::PARAM_INT);
            $stmt->bindParam(':ano_modelo', $dados['ano_modelo'], PDO::PARAM_INT);
            $stmt->bindParam(':cor', $dados['cor']);
            $stmt->bindParam(':placa', $dados['placa']);
            $stmt->bindParam(':chassi', $dados['chassi']);
            $stmt->bindParam(':km', $dados['km'], PDO::PARAM_INT);
            $stmt->bindParam(':preco_compra', $dados['preco_compra']);
            $stmt->bindParam(':preco_venda', $dados['preco_venda']);
            $stmt->bindParam(':status', $dados['status']);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar carro ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    // Excluir carro
    public function excluir($id) {
        try {
            $query = "DELETE FROM carros WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir carro ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    // Método para atualizar status (ex: quando vender)
    public function atualizarStatus($id, $status) {
        try {
            $query = "UPDATE carros SET status = :status WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar status do carro ID {$id}: " . $e->getMessage());
            return false;
        }
    }
}
?>