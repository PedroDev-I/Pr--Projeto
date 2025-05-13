<?php
require_once '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cpf   = $_POST['cpf'] ?? '';
    $nome  = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $imagemNome = '';

    // Verifica se imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagemNome = uniqid() . '.' . $ext;
        $caminho = '../assets/img/profile/' . $imagemNome;

        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            die('Erro ao salvar a imagem.');
        }
    } else {
        die('Imagem de perfil é obrigatória.');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO cliente (cpf, nome, email, perfil) 
                               VALUES (:cpf, :nome, :email, :perfil)");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':perfil', $imagemNome);
        $stmt->execute();

        header("Location: ../pages/page_clientes.php?msg=Cliente adicionado com sucesso");
        exit;
    } catch (PDOException $e) {
        echo "Erro ao adicionar cliente: " . $e->getMessage();
    }
} else {
    echo "Requisição inválida.";
}
