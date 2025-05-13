<?php
require_once '../includes/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM cliente WHERE id_cliente = :id_cliente");
            $stmt->bindParam(':id_cliente', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: ../pages/page_clientes.php?msg=Cliente excluído com sucesso");
            exit;
        } catch (PDOException $e) {
            echo "Erro ao excluir cliente: " . $e->getMessage();
        }
    } else {
        echo "ID inválido.";
    }
} else {
    echo "ID do cliente não foi informado.";
}
?>
