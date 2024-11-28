<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $data_entrada = $_POST['data_entrada'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];

    $query = $conn->prepare("INSERT INTO funcionarios (nome, data_nascimento, data_entrada, cpf, rg, endereco, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("sssssss", $nome, $data_nascimento, $data_entrada, $cpf, $rg, $endereco, $email);

    if ($query->execute()) {
        echo "Funcionário adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar funcionário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?></h1>
    <h2>Adicionar Funcionário</h2>
    <form method="POST" action="dashboard.php">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br>
        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" required>
        <br>
        <label>Data de Entrada:</label>
        <input type="date" name="data_entrada" required>
        <br>
        <label>CPF:</label>
        <input type="text" name="cpf" required>
        <br>
        <label>RG:</label>
        <input type="text" name="rg" required>
        <br>
        <label>Endereço:</label>
        <textarea name="endereco" required></textarea>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <button type="submit">Adicionar</button>
    </form>
    <h2>Funcionários</h2>
    <ul>
        <?php
        $result = $conn->query("SELECT * FROM funcionarios");
        while ($funcionario = $result->fetch_assoc()) {
            echo "<li>" . $funcionario['nome'] . " - " . $funcionario['email'] . "</li>";
        }
        ?>
    </ul>
    <a href="logout.php">Sair</a>
</body>
</html>
