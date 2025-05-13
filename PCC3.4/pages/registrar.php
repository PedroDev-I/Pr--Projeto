<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/registerpage.css">
    <title>Registrar | AnimalSave</title>
</head>
<body>
    <form action="../actions/registrar_action.php" class="card-register" method="POST">
        <header><img src="../assets/img/LOGO_2.jpg" alt="logo"></header>
        <div class="card-mid">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome..." required>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Digite seu e-mail..." required>

            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF..." required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha..." required>
                
            <button type="submit">Registrar</button>

            <p>Já possiu <a href="login.php" style="text-decoration: none;">?Conta</a></p>
        </div>
    </form>
</body>
</html>