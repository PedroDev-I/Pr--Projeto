<?php 
require "../includes/config.php";

$nome = filter_input(INPUT_POST, "nome");
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$cpf = filter_input(INPUT_POST, "cpf");
$senha = filter_input(INPUT_POST, "senha");

if ($nome && $email && $cpf && $senha) {
   
    $sql = $pdo->prepare("SELECT * FROM cliente WHERE email = :email OR cpf = :cpf");
    $sql->bindValue(':email', $email);
    $sql->bindValue(':cpf', $cpf);
    $sql->execute();

    if ($sql->rowCount() === 0) {
      
        $sql = $pdo->prepare("INSERT INTO cliente (nome, email, cpf, senha) VALUES (:nome, :email, :cpf, :senha)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':cpf', $cpf);
        $sql->bindValue(':senha', password_hash($senha, PASSWORD_DEFAULT)); 
        $sql->execute();

        header("Location: ../pages/login.php"); 
        exit;
    } else {
        echo "E-mail ou CPF já cadastrado.";
    }
} else {
    echo "Preencha todos os campos corretamente.";
}
?>