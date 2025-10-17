<?php 

$host = "localhost";        // ou o IP do servidor, ex: "127.0.0.1"
$user = "root";       // nome de utilizador da base de dados
$pass = "";    // password do utilizador
$dbname = "test"; // nome da base de dados

$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica se a ligação teve sucesso
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}/*else {
    echo("conexao feita com sucesso");
}
*/
?>