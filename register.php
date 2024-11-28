<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
    $query->bind_param("ss", $usuario, $senha);

    if ($query->execute()) {
        echo "Usuário registrado com sucesso!";
    } else {
        echo "Erro ao registrar usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<body>
    <h1>Registrar Usuário</h1>
    <form method="POST" action="register.php">
        <label>Usuário:</label>
        <input type="text" name="usuario" required>
        <br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
