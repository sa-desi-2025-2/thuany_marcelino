<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body style="height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow: hidden;">

    <div class="container-fluid h-100">

        <!-- Início da Barra de navegação -->
        <nav class="navbar-top"
            style="display: flex; justify-content: flex-end; align-items: center; padding: 10px 20px; background-color: white; border-bottom: 1px solid #ccc;">

            <div style="display: flex; align-items: center; margin-right: auto;">
                <img src="../../logo_whp.png" alt="logo da whirlpool" width="150" height="50">
            </div>
            <div style="display: flex; gap: 20px; align-items: center;">

                <a href="../../Backend/Main/main_cadastro.php"
                    style="font-size: 17px; color: #333; text-decoration: none;"><i class="bi bi-person-gear"
                        style="font-size: 20px; margin-right: 5px;"></i> Gerenciar usuários</a>
                <a href="../../index.php"
                    style="font-size: 17px; color: #333; text-decoration: none;"><i class="bi bi-arrow-bar-left"
                        style="font-size: 20px; margin-right: 5px;"></i> Sair</a>
            </div>
        </nav>
        <!-- Fim da Barra de navegação -->

        <div class="row h-100" style="flex: 1;">

            <!-- Fundo Lado esquerdo -->
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-start ps-5"
                style="background-color: #0b3553; color: white;">
                <!-- Menu suspenso Fábrica 2 -->
                <div class="dropdown">
                    <button style="background-color: #0b3553; color: white; font-size: 3rem;"
                        class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>Fábrica 2</b>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item">Linha 1</a></li>
                        <li><a class="dropdown-item">Linha 2</a></li>
                        <li><a class="dropdown-item">Linha 3</a></li>
                        <li><a class="dropdown-item">Linha 6</a></li>
                        <li><a class="dropdown-item">Linha 8</a></li>
                        <li><a class="dropdown-item">Linha 9</a></li>
                    </ul>
                </div>
                <!-- Menu suspenso Fábrica 3 -->
                <div class="dropdown">
                    <button style="background-color: #0b3553; color: white; font-size: 3rem;"
                        class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>Fábrica 3</b>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item">Linha 1</a></li>
                        <li><a class="dropdown-item">Linha 2</a></li>
                        <li><a class="dropdown-item">Linha 3</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>