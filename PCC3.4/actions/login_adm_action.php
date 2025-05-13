<?php
session_start();
require '../includes/config.php';


$codigo = filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
$senha = filter_input(INPUT_POST, 'senha');

if ($codigo && $senha) {

    $sql = $pdo->prepare("SELECT * FROM adm WHERE codigo = :codigo");
    $sql->bindValue(':codigo', $codigo);
    $sql->execute();


    if ($sql->rowCount() > 0) {
        $admin = $sql->fetch(PDO::FETCH_ASSOC);


        if ($senha == $admin['senha']) {
            $_SESSION['id_admin'] = $admin['cpf'];
            $_SESSION['nome_admin'] = $admin['nome'];

            header("Location: ../pages/admdashboard.php");
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Administrador não encontrado.";
    }
} else {
    echo "Preencha todos os campos!";
}
?>
