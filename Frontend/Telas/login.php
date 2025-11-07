<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela de Login</title>
</head>
<body>
    <h2>Login</h2>

    <form action="../../Backend/Main/main_login.php" method="POST">
        <label>Nome de Usuário:</label><br>
        <input type="text" name="nome_usuario" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">LOGIN</button>
    </form>

    <?php
    if (isset($_SESSION['erro_login'])) {
        echo "<p style='color:red'>" . $_SESSION['erro_login'] . "</p>";
        unset($_SESSION['erro_login']);
    }
    ?>
</body>
</html>