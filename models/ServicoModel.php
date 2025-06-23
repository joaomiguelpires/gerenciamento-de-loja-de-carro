<?php
class ServicoModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarServicos($filtro = []) {
        try {
            $query = "SELECT id, nome, descricao, preco FROM servicos WHERE 1=1";
            $params = [];
            if (!empty($filtro['busca'])) {
                $query .= " AND (nome LIKE :busca OR descricao LIKE :busca)";
                $params[':busca'] = "%{$filtro['busca']}%";
            }
            $query .= " ORDER BY nome ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar serviços: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            $query = "SELECT * FROM servicos WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function cadastrar($dados) {
        try {
            $query = "INSERT INTO servicos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            $stmt->bindParam(':preco', $dados['preco']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar serviço: " . $e->getMessage());
            return false;
        }
    }

    public function atualizar($id, $dados) {
        try {
            $query = "UPDATE servicos SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            $stmt->bindParam(':preco', $dados['preco']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function excluir($id) {
        try {
            $query = "DELETE FROM servicos WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir serviço ID {$id}: " . $e->getMessage());
            return false;
        }
    }
}
?> 