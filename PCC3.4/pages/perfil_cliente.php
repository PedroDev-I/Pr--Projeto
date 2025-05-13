<?php
session_start();
require '../includes/config.php';


if (!isset($_SESSION['id_cliente'])) {
    header("Location: login_cliente.php");
    exit;
}


$id = $_SESSION['id_cliente'];
$sql = $pdo->prepare("SELECT * FROM cliente WHERE id_cliente = :id");
$sql->bindValue(':id', $id);
$sql->execute();
$user = $sql->fetch(PDO::FETCH_ASSOC);


if (!$user) {
    session_destroy();
    header("Location: login_cliente.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuário</title>
    <link rel="stylesheet" href="../assets/css/cliente_perfil/perfil_client.css">
</head>
<body>
    <nav class="row-menu">
        <a href="#">Pedidos</a>
        <a href="#">Perfil</a>
        <div class="logout">
        <a href="../actions/logout.php">Sair</a>
        </div>
    </nav>

    <header>
        <img src="user-profile.jpg" alt="Foto de Perfil">
        <h1>Olá, <?php echo htmlspecialchars($user['nome']); ?>!</h1>
    </header>

    <section class="perfil">
        <h2>Informações do Perfil</h2>
        <form action="#" method="POST">
            <div class="input-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required>
            </div>
            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="input-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($user['telefone']); ?>" required>
            </div>
            <button type="submit">Atualizar Informações</button>
        </form>
    </section>

    <footer class="footer">
        <div class="footer-container">
          <div class="footer-nav">
            <ul>
              <li><a href="#">Retornar à Loja</a></li>
              <li><a href="#">Sobre</a></li>
              <li><a href="#">Contato</a></li>
              <li><a href="#">Suporte</a></li>
            </ul>
          </div>
          <div class="footer-info">
            <p>
              Seja bem-vindo ao AnimalSave, o petshop que entende que seu pet é mais do que um animal de estimação – é parte da família. Aqui, cada detalhe foi pensado com carinho para oferecer o melhor em cuidados, alimentação e bem-estar para cães, gatos e outros companheiros de quatro patas.
            </p>
            <div class="footer-social">
              <a href="#" target="_blank"><i class="fab fa-facebook fa-3x"></i></a>
              <a href="#" target="_blank"><i class="fab fa-instagram fa-3x"></i></a>
              <a href="#" target="_blank"><i class="fab fa-twitter fa-3x"></i></a>
              <a href="#" target="_blank"><i class="fab fa-whatsapp fa-3x"></i></a>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          &copy; 2025 Copyright: <a href="index.html">AnimalSave</a>
        </div>
      </footer>
</body>
</html>
