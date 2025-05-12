<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/loginpage.css">
    <title>ADMINISTRAÇÃO| AnimalSave</title>
</head>
<body>
    <form action="../actions/login_action.php" class="card-login" method="POST">
        <header><img src="../assets/img/LOGO_2.jpg" alt="logo"></header>
        <div class="card-mid">

            <label for="code">Código</label>
            <input type="password" name="code" id="code" placeholder="Digite seu código..." required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha..." required>

            <button type="submit">Entrar</button>
        </div>
    </form>
</body>
</html>
