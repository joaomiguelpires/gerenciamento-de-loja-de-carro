<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config/database.php';
    require_once 'models/CarroModel.php';
    
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    // Validação básica (substitua por consulta ao banco)
    if ($login === 'admin' && $senha === '1234') {
        $_SESSION['logado'] = true;
        header("Location: index.php");
        exit();
    } else {
        $erro = "Login ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <h2 style="color: #007bff; letter-spacing: 2px; font-weight: bold; text-shadow: 0 2px 8pxrgb(2, 2, 2); margin-bottom: 2rem; text-align: center;">CIDOMOTORS</h2>
            <input type="text" name="login" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>