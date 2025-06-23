<?php
class ClienteModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarClientes($filtro = []) {
        try {
            $query = "SELECT id, nome, cpf, telefone, email, endereco FROM clientes WHERE 1=1";
            $params = [];
            if (!empty($filtro['busca'])) {
                $query .= " AND (nome LIKE :busca OR cpf LIKE :busca)";
                $params[':busca'] = "%{$filtro['busca']}%";
            }
            $query .= " ORDER BY nome ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar clientes: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            $query = "SELECT * FROM clientes WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar cliente ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function cadastrar($dados) {
        try {
            $query = "INSERT INTO clientes (nome, cpf, telefone, email, endereco) VALUES (:nome, :cpf, :telefone, :email, :endereco)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':cpf', $dados['cpf']);
            $stmt->bindParam(':telefone', $dados['telefone']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':endereco', $dados['endereco']);
            if ($stmt->execute()) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                return $errorInfo[2] ?? 'Erro desconhecido ao inserir no banco.';
            }
        } catch (PDOException $e) {
            die("Erro PDO: " . $e->getMessage());
        }
    }

    public function atualizar($id, $dados) {
        try {
            $query = "UPDATE clientes SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, endereco = :endereco WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':cpf', $dados['cpf']);
            $stmt->bindParam(':telefone', $dados['telefone']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':endereco', $dados['endereco']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar cliente ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function excluir($id) {
        try {
            $query = "DELETE FROM clientes WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir cliente ID {$id}: " . $e->getMessage());
            return false;
        }
    }
}
?> 