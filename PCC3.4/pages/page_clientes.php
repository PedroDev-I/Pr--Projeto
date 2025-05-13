<?php
require '../includes/config.php';
$lista = [];
$sql = $pdo->query("SELECT * FROM cliente");
if($sql->rowCount() > 0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<link rel="stylesheet" href="../assets/css/adm_page/admprodt.css">

<form action="../actions/adicionar_cliente_action.php" method="POST" enctype="multipart/form-data">

    <a href="../pages/admdashboard.php" class="voltar-btn">
        <img src="../assets/img/dashboardadm/addprodt/back.png" alt="Voltar">
    </a>

    <a href="javascript:void(0);" onclick="document.getElementById('popupModal').style.display='block'" style="background-color: gold; color:white;border-radius:50px;padding: 10px 30px;">Adicionar Cliente</a>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Perfil</th>
            <th>CPF</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>

        <?php foreach($lista as $usuario): ?>
            <tr>
                <td><?=$usuario['id_cliente'];?></td>
                <td><img src="../assets/img/profile/<?=$usuario['perfil'];?>" width="50" alt="Imagem do cliente"></td>
                <td><?=$usuario['cpf'];?></td>
                <td><?=$usuario['nome'];?></td>
                <td><?=$usuario['email'];?></td>
                <td>
                    <a href="javascript:void(0);" onclick='abrirEdicaoCliente(<?= json_encode($usuario); ?>)' style="background-color: green; border-radius:100px; color:white; padding: 3%; margin-right: 10px;">Editar</a>
                    <br>
                    <a href="../actions/excluir_cliente.php?id=<?=$usuario['id_cliente'];?>" onclick="return confirm('Você tem certeza que deseja excluir esse usuário?')" style="background-color: red; border-radius:100px;color:white;padding:3%;">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</form>

<!-- Modal de Adicionar Cliente -->
<div id="popupModal" style="display:none;">
    <div style="background-color:white; padding:20px; max-width:500px; margin:auto; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); position: fixed; top: 10%; left: 50%; transform: translateX(-50%); z-index: 1000;">
        <span onclick="document.getElementById('popupModal').style.display='none'" style="color:red; font-size:30px; cursor:pointer;">&times;</span>
        <h2>Adicionar Cliente</h2>

        <form action="../actions/adicionar_cliente_action.php" method="POST" enctype="multipart/form-data">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required><br><br>

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="imagem">Imagem de Perfil:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required><br><br>

            <input type="submit" value="Adicionar Cliente">
        </form>
    </div>
</div>

<!-- Modal de Editar Cliente -->
<div id="popupEditModalCliente" style="display:none;">
    <div style="background-color:white; padding:20px; max-width:500px; margin:auto; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); position: fixed; top: 10%; left: 50%; transform: translateX(-50%); z-index: 1000;">
        <span onclick="document.getElementById('popupEditModalCliente').style.display='none'" style="color:red; font-size:30px; cursor:pointer;">&times;</span>
        <h2>Editar Cliente</h2>

        <form action="../actions/editar_cliente.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="edit_id_cliente" name="id_cliente">

            <label for="edit_cpf_cliente">CPF:</label>
            <input type="text" id="edit_cpf_cliente" name="cpf" required><br><br>

            <label for="edit_nome_cliente">Nome:</label>
            <input type="text" id="edit_nome_cliente" name="nome" required><br><br>

            <label for="edit_email_cliente">Email:</label>
            <input type="email" id="edit_email_cliente" name="email" required><br><br>

            <label for="edit_imagem_cliente">Nova Imagem (opcional):</label>
            <input type="file" id="edit_imagem_cliente" name="imagem"><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>
    </div>
</div>

<script>
function abrirEdicaoCliente(cliente) {
    document.getElementById('edit_id_cliente').value = cliente.id_cliente;
    document.getElementById('edit_cpf_cliente').value = cliente.cpf;
    document.getElementById('edit_nome_cliente').value = cliente.nome;
    document.getElementById('edit_email_cliente').value = cliente.email;
    document.getElementById('popupEditModalCliente').style.display = 'block';
}
</script>

