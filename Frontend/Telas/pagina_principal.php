<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">

    <!-- Início da Barra de navegação -->
    <nav class="navbar-top"
        style="display: flex; justify-content: flex-end; align-items: center; padding: 10px 20px; background-color: white; border-bottom: 1px solid #ccc;">
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="../../Backend/Main/main_cadastro.php" style="font-size: 14px; color: #333;">Gerenciar usuários</a>
            <!-- arrumar o direcionamento do link abaixo -->
            <a href="../../Backend/Main/main_cadastro.php" style="font-size: 14px; color: #333; text-decoration: none;">Sair</a>
        </div>
    </nav>

    <div class="sidebar-menu" style="background-color: #0b3553;">
    </div>

    </div>
    </nav>
    <!-- Fim da Barra de navegação -->

    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Fundo Lado esquerdo -->
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-start ps-5"
                style="background-color: #0b3553; color: white;">
                <!-- Menu suspenso Fábrica 2 -->
                <div class="dropdown">
                    <button style="background-color: #0b3553; color: white; font-size: 2rem;"
                        class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>Fábrica 2</b>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Linha 1</a></li>
                        <li><a class="dropdown-item" href="#">Linha 2</a></li>
                        <li><a class="dropdown-item" href="#">Linha 3</a></li>
                        <li><a class="dropdown-item" href="#">Linha 6</a></li>
                        <li><a class="dropdown-item" href="#">Linha 8</a></li>
                        <li><a class="dropdown-item" href="#">Linha 9</a></li>
                    </ul>
                </div>
                <!-- Menu suspenso Fábrica 3 -->
                <div class="dropdown">
                    <button style="background-color: #0b3553; color: white; font-size: 2rem;"
                        class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>Fábrica 3</b>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Linha 1</a></li>
                        <li><a class="dropdown-item" href="#">Linha 2</a></li>
                        <li><a class="dropdown-item" href="#">Linha 3</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>