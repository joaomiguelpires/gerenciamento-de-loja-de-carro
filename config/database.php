<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'loja_carros'; // Nome do banco que criamos
    private $username = 'root'; // Usuário padrão do XAMPP
    private $password = ''; // Senha padrão do XAMPP (vazia)
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}", 
                $this->username, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Mostra erro mais amigável
            die("Erro de conexão: " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>