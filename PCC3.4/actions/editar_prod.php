<?php
require '../includes/config.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados do formulário
    $id = $_POST['id_produto'];
    $nome = $_POST['nome_produto'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    // Lida com o upload da imagem, se houver
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagemNome = uniqid() . basename($_FILES['imagem']['name']);
        $imagemCaminho = '../assets/img/produtos/' . $imagemNome;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagemCaminho)) {
            // Atualiza com nova imagem
            $sql = $pdo->prepare("UPDATE produto SET nome_produto = ?, descricao = ?, preco = ?, estoque = ?, imagem = ? WHERE id_produto = ?");
            $sql->execute([$nome, $descricao, $preco, $estoque, $imagemNome, $id]);
        } else {
            echo "Erro ao salvar a nova imagem.";
            exit;
        }
    } else {
        // Atualiza sem alterar a imagem
        $sql = $pdo->prepare("UPDATE produto SET nome_produto = ?, descricao = ?, preco = ?, estoque = ? WHERE id_produto = ?");
        $sql->execute([$nome, $descricao, $preco, $estoque, $id]);
    }

    // Redireciona de volta para a página de produtos
    header("Location: ../pages/cadastrar_produtos.php");
    exit;
} else {
    echo "Requisição inválida.";
}
