<?php
class OrdemServicoModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarOrdens($filtro = []) {
        try {
            $query = "SELECT os.id, os.data_ordem, os.valor_total, os.status, os.observacoes,
                             c.nome AS cliente_nome, ca.modelo AS carro_modelo, s.nome AS servico_nome
                      FROM ordens_servico os
                      JOIN clientes c ON os.cliente_id = c.id
                      JOIN carros ca ON os.carro_id = ca.id
                      JOIN servicos s ON os.servico_id = s.id
                      WHERE 1=1";
            $params = [];
            if (!empty($filtro['busca'])) {
                $query .= " AND (c.nome LIKE :busca OR ca.modelo LIKE :busca OR s.nome LIKE :busca)";
                $params[':busca'] = "%{$filtro['busca']}%";
            }
            $query .= " ORDER BY os.data_ordem DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar ordens de serviço: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            $query = "SELECT os.*, c.nome AS cliente_nome, ca.modelo AS carro_modelo, s.nome AS servico_nome
                      FROM ordens_servico os
                      JOIN clientes c ON os.cliente_id = c.id
                      JOIN carros ca ON os.carro_id = ca.id
                      JOIN servicos s ON os.servico_id = s.id
                      WHERE os.id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar ordem de serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function cadastrar($dados) {
        try {
            $query = "INSERT INTO ordens_servico (carro_id, cliente_id, servico_id, data_ordem, valor_total, status, observacoes)
                      VALUES (:carro_id, :cliente_id, :servico_id, :data_ordem, :valor_total, :status, :observacoes)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':carro_id', $dados['carro_id']);
            $stmt->bindParam(':cliente_id', $dados['cliente_id']);
            $stmt->bindParam(':servico_id', $dados['servico_id']);
            $stmt->bindParam(':data_ordem', $dados['data_ordem']);
            $stmt->bindParam(':valor_total', $dados['valor_total']);
            $stmt->bindParam(':status', $dados['status']);
            $stmt->bindParam(':observacoes', $dados['observacoes']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar ordem de serviço: " . $e->getMessage());
            return false;
        }
    }

    public function atualizar($id, $dados) {
        try {
            $query = "UPDATE ordens_servico SET carro_id = :carro_id, cliente_id = :cliente_id, servico_id = :servico_id, data_ordem = :data_ordem, valor_total = :valor_total, status = :status, observacoes = :observacoes WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':carro_id', $dados['carro_id']);
            $stmt->bindParam(':cliente_id', $dados['cliente_id']);
            $stmt->bindParam(':servico_id', $dados['servico_id']);
            $stmt->bindParam(':data_ordem', $dados['data_ordem']);
            $stmt->bindParam(':valor_total', $dados['valor_total']);
            $stmt->bindParam(':status', $dados['status']);
            $stmt->bindParam(':observacoes', $dados['observacoes']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar ordem de serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function excluir($id) {
        try {
            $query = "DELETE FROM ordens_servico WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir ordem de serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }
}
?> 