<?php
session_start();
require '../includes/config.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if ($email && $senha) {
    $sql = $pdo->prepare("SELECT * FROM cliente WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    
        if (password_verify($senha, $usuario['senha'])) {
      
            $_SESSION['id_cliente'] = $cliente['id'];
            $_SESSION['nome'] = $cliente['nome'];
            header("Location: ../index.html");
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Preencha todos os campos!";
}
?>