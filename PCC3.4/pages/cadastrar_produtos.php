<link rel="stylesheet" href="../assets/css/adm_page/admprodt.css">

<form action="../action/adicionar_produto_action.php" method="POST" enctype="multipart/form-data">

    <a href="../pages/admdashboard.php" class="voltar-btn">
        <img src="../assets/img/dashboardadm/addprodt/back.png" alt="Voltar">
    </a>

    <?php
    require '../includes/config.php';
    $lista = [];
    $sql = $pdo->query("SELECT * FROM produto");
    if($sql->rowCount() > 0){
        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>

    <a href="javascript:void(0);" onclick="document.getElementById('popupModal').style.display='block'" style="background-color: gold; color:white;border-radius:50px;padding: 10px 30px;">Adicionar Produto</a>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Imagem</th>
            <th>Produto</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>

        <?php foreach($lista as $usuario): ?>
            <tr>
                <td><?=$usuario['id_produto'];?></td>
                <td><img src="../assets/img/produtos/<?=$usuario['imagem'];?>" width="50" alt="Imagem do produto"></td>
                <td><?=$usuario['nome_produto'];?></td>
                <td><?=$usuario['descricao'];?></td>
                <td>R$ <?= number_format($usuario['preco'], 2, ',', '.'); ?></td>
                <td><?=$usuario['estoque'];?></td>
                <td>
                <a href="javascript:void(0);" onclick='abrirEdicao(<?= json_encode($usuario); ?>)'style="background-color: green; border-radius:100px; color:white; padding: 3%; margin-right: 10px;">Editar</a>
 <br>
                    <a href="../actions/excluir_prod.php?id=<?=$usuario['id_produto'];?>" onclick="return confirm('Você tem certeza que deseja excluir esse usuário?')" style=";background-color: red; border-radius:100px;color:white;padding:3%;">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</form>

<div id="popupModal" style="display:none;">
    <div style="background-color:white; padding:20px; max-width:500px; margin:auto; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); position: fixed; top: 10%; left: 50%; transform: translateX(-50%); z-index: 1000;">
        <span onclick="document.getElementById('popupModal').style.display='none'" style="color:red; font-size:30px; cursor:pointer;">&times;</span>
        <h2>Adicionar Produto</h2>

        <form action="../actions/adicionar_produto_action.php" method="POST" enctype="multipart/form-data">
            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto" required><br><br>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea><br><br>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" required><br><br>

            <label for="imagem">Imagem do Produto:</label>
            <input type="file" id="imagem" name="imagem" required><br><br>

            <label for="estoque">Estoque:</label>
            <input type="number" id="estoque" name="estoque" required><br><br>

            <input type="submit" value="Adicionar Produto">
        </form>
    </div>
</div>


<div id="overlay" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;"></div>

<div id="popupEditModal" style="display:none;">
    <div style="background-color:white; padding:20px; max-width:500px; margin:auto; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); position: fixed; top: 10%; left: 50%; transform: translateX(-50%); z-index: 1000;">
        <span onclick="document.getElementById('popupEditModal').style.display='none'" 
              style="color:red; font-size:30px; cursor:pointer;">&times;</span>
        <h2>Editar Produto</h2>

        <form action="../actions/editar_prod.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="edit_id" name="id_produto">

            <label for="edit_nome_produto">Nome do Produto:</label>
            <input type="text" id="edit_nome_produto" name="nome_produto" required><br><br>

            <label for="edit_descricao">Descrição:</label>
            <textarea id="edit_descricao" name="descricao" required></textarea><br><br>

            <label for="edit_preco">Preço:</label>
            <input type="number" id="edit_preco" name="preco" step="0.01" required><br><br>

            <label for="imagem">Nova Imagem (opcional):</label>
            <input type="file" name="imagem"><br><br>

            <label for="edit_estoque">Estoque:</label>
            <input type="number" id="edit_estoque" name="estoque" required><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>
    </div>
</div>


<script>
function abrirEdicao(produto) {
    document.getElementById('edit_id').value = produto.id_produto;
    document.getElementById('edit_nome_produto').value = produto.nome_produto;
    document.getElementById('edit_descricao').value = produto.descricao;
    document.getElementById('edit_preco').value = produto.preco;
    document.getElementById('edit_estoque').value = produto.estoque;
    document.getElementById('popupEditModal').style.display = 'block';
}
</script>
