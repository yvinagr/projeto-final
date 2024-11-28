<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $query = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $query->bind_param("s", $usuario);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = $usuario;
            header("Location: dashboard.php");
            exit;
        }
    }
    echo "Usuário ou senha incorretos.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyles.css">
</head>
<body>
<div class="container">
        <header>
            <img src="Logo.png" alt="Logo da Empresa" style="width: 100px; height: auto;">
        </header>
        <h1>Login</h1>
    <form method="POST" action="login.php">
        <label>Usuário:</label>
        <input type="text" name="usuario" required>
        <br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <button type="submit">Entrar</button>
        <button type="register.php">registre-se</button>
    </form>
    </div>
</body>
</html>
