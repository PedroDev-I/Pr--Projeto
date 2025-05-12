<?php
require_once '../includes/config.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome_produto'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $estoque = $_POST['estoque'] ?? '';
    $imagemNome = '';

    // Verifica se a imagem foi enviada e move o arquivo
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagemNome = uniqid() . '.' . $ext;
        $caminho = '../assets/img/produtos/' . $imagemNome;

        // Move o arquivo
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            die('Erro ao salvar a imagem.');
        }
    } else {
        die('Imagem do produto é obrigatória.');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO produto (nome_produto, descricao, preco, imagem, estoque) 
                               VALUES (:nome, :descricao, :preco, :imagem, :estoque)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem', $imagemNome);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->execute();

        header("Location: ../pages/cadastrar_produtos.php?msg=Produto adicionado com sucesso");
        exit;
    } catch (PDOException $e) {
        echo "Erro ao adicionar produto: " . $e->getMessage();
    }
} else {
    echo "Requisição inválida.";
}
?>
