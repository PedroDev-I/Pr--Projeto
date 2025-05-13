<?php
require_once '../includes/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM produto WHERE id_produto = :id_produto");
            $stmt->bindParam(':id_produto', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: ../pages/cadastrar_produtos.php?msg=Cliente excluído com sucesso");
            exit;
        } catch (PDOException $e) {
            echo "Erro ao excluir produto: " . $e->getMessage();
        }
    } else {
        echo "ID inválido.";
    }
} else {
    echo "ID do produto não encotrado.";
}
?>
