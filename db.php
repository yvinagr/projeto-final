<?php
$host = "localhost";
$user = "root"; // Usuário padrão do MySQL
$password = ""; // Geralmente vazio no XAMPP/WAMP
$dbname = "sistema_funcionarios";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
