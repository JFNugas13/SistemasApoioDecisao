<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['botao'])) {
        $email = trim($_POST['email']);
        $senha = trim($_POST['password']);

        if ($email and $senha == "") {
            echo "Por favor, preencha todos os campos.";
            exit;
        }

        $sql = ("SELECT email, password FROM colaboradores WHERE email = ? and password = ?");
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Login bem-sucedido!";
        } else {
            echo "Email ou senha incorretos.";
        }    
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
         <input type="email" placeholder="Email" name="email" required />
        <input type="password" placeholder="Senha" name="password" required />
        <button type="submit" name="botao">Enviar</button>
    </form>
</body>
</html>