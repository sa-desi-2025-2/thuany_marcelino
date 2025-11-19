<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Tela de Login - EWO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">

    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Fundo Lado esquerdo -->
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-start ps-5"
                style="background-color: #0b3553; color: white;">
                <h1 style="font-size: 3rem;"><b>EWO</b></h1>
                <p style="font-size: 1.1rem; opacity: 0.8;">Emergency Worker Order - Análise de Falhas</p>
            </div>

            <!-- Fundo Lado direito -->
            <div class="col-md-7 d-flex flex-column justify-content-center align-items-center bg-white">

                <!-- Div de Login -->
                <div style="background-color: #e0e0e0; padding: 40px; border-radius: 10px; 
                            box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 320px;">
                    <form action="Backend/Main/main_login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nome de usuário</label>
                            <input type="text" class="form-control" name="nome_usuario" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" required>
                        </div>

                        <button type="submit" class="btn w-100"
                            style="background-color: #0b3553; color: white; border-radius: 8px;">
                            Login
                        </button>
                    </form>
                    
                    <?php
                    if (isset($_SESSION['erro_login'])) {
                        echo "<p style='color:red; margin-top:10px;'>" . $_SESSION['erro_login'] . "</p>";
                        unset($_SESSION['erro_login']);
                    }
                    ?>
                </div>
                <br>
                <form action="Backend/Main/main_planilha.php" method="POST">
                    <button type="submit" class="btn w-100"
                            style="background-color: #0b3553; color: white; border-radius: 8px;">
                            Atualizar planilha
                        </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>