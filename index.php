<body>
    <div class="container">
        <h2>Login - Reciclagem App</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" name="user" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" name="pw" required>
            </div>
            <button type="submit" name="logar">Entrar</button>
            <button type="submit" name="register">Registrar</button>
        </form>
    </div>
</body>
</html>

<?php
include "config.php";
session_start();

$user = "";
$pw = "";

if (isset($_POST['register'])) {
    $user = $_POST['user'];
    $pw = $_POST['pw'];

    $login = $conn->prepare('INSERT INTO `login1` (`id_log`, `user_log`, `pass_log`) VALUES (NULL, :user, :pw)');
    $login->bindValue(":user", $user);
    $login->bindValue(":pw", $pw);
    if ($login->execute()) {
        echo "Registrado com sucesso";
    } else {
        echo "Erro ao inserir os dados.";
    }
} else if (isset($_POST['logar'])) {
    $login = $conn->prepare('SELECT * FROM `login1` WHERE `user_log` = :user AND `pass_log` = :pw');
    $login->bindValue(":user", $user);
    $login->bindValue(":pw", $pw);
    $login->execute();
    if ($login->rowCount() == 0) {
        echo "Login ou senha inválida!";
    } else {
        $cons = $login->fetch();
        $id = $cons['id_log'];
        $_SESSION['login1'] = $id;
        header("location: login.php");
    }
}
?>

