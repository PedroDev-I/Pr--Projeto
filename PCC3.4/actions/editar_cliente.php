<?php
require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_cliente'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($id) || empty($cpf) || empty($nome) || empty($email)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = uniqid() . '.' . $extensao;
        $caminhoImagem = '../assets/img/profile/' . $nomeImagem;

        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            echo "Erro ao salvar a imagem.";
            exit;
        }

        // Atualiza com nova imagem
        $sql = $pdo->prepare("UPDATE cliente SET cpf = ?, nome = ?, email = ?, perfil = ? WHERE id_cliente = ?");
        $sql->execute([$cpf, $nome, $email, $nomeImagem, $id]);
    } else {
        // Atualiza sem imagem
        $sql = $pdo->prepare("UPDATE cliente SET cpf = ?, nome = ?, email = ? WHERE id_cliente = ?");
        $sql->execute([$cpf, $nome, $email, $id]);
    }

    header("Location: ../pages/page_clientes.php");
    exit;
} else {
    echo "Requisição inválida.";
}
