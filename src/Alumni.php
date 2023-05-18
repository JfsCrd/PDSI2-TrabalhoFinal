<?php
session_start();
$usuario = $_SESSION['usuario'];

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PORTAL | ALUMNI FACOM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Portal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">

</head>

<body>

    <nav class="navbar navbar-light navbar-expand-md" style="background: #f2f2f2; font-family: Roboto;">
        <div class="container-fluid">
            <a class="navbar-brand disabled" style="margin-left: 45px; cursor: default;">ALUMNI FACOM UFU</a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span
                    class="visually-hidden">Mudar navegação</span><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1" style="background: #f2f2f2;">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link disabled" style="color:#212B58" href="Alumni.php">Início</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="Busca.php">Buscar</a></li>
                    <li class="nav-item"><a class="nav-link" href="Forum.php">Fórum</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Oportunidades</a></li>
                </ul>
                <div class="ms-auto d-flex align-items-center" style="margin-right: 10px;">
                    <div class="dropdown ms-auto">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 0%;">
                            <span>Bem-vindo,
                                <?php echo $_SESSION["usuario"]; ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="Alumni.php">Meu Perfil</a></li>
                            <li><a class="dropdown-item" href="Editar-perfil.php">Editar Dados</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item " role="button" id='botao-logout' style="color: red"
                                    href="Login.html">Sair</a></li>
                        </ul>
                    </div>
                    </ul>
                </div>
            </div>
    </nav>
    <div class="wrapper">
        <div class="content">
            <div data-bss-parallax-bg="false"
                style="background-image: url(assets/img/Institucional-Bg.png);background-position: center;background-size: cover;">
                <h1 style="color: #F8AB02; margin: 40px">Bem-vindo ao nosso portal alumni!</h1>
                <p style="color:#f2f2f2; margin: 40px; margin-right: 150px; font-size: 18px; text-align: justify">Conecte-se com colegas e fique atualizado sobre notícias, oportunidades e histórias inspiradoras da faculdade.</p>

            </div>

            <!-- Start: Ações -->
            <div class="container">
                <div class="row" style="padding-top: 50px;">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-search fa-3x"></i>
                            <h3>Busca</h3>
                            <p>Encontre pessoas e crie conexões.</p>
                            <a href="Busca.php" class="btn btn-primary btn-sm" style="border-radius:0px">Procurar</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-comments fa-3x"></i>
                            <h3>Fórum</h3>
                            <p>Compartilhe suas opiniões, perguntas e ideias.</p>
                            <a href="Forum.php" class="btn btn-primary btn-sm" style="border-radius:0px">Ir para o
                                fórum</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-briefcase fa-3x"></i>
                            <h3>Oportunidades</h3>
                            <p>Encontre oportunidades de emprego .</p>
                            <a href="#" class="btn btn-primary btn-sm" style="border-radius:0px">Ver oportunidades</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Ações -->

    <!-- Start: Footer Basic -->
    <footer class="footer-basic" style="position: relative; padding-bottom: 15px; padding-top: 30px;">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Início</a></li>
            <li class="list-inline-item"></li>
            <li class="list-inline-item"><a href="Institucional.html">Sobre</a></li>
            <li class="list-inline-item"></li>
            <li class="list-inline-item"><a href="Institucional.html">Política de Privacidade</a></li>
        </ul>
        <p class="copyright">FACOM | Universidade Federal de Uberlândia © 2023</p>
    </footer><!-- End: Footer Basic -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
    <script src="assets/js/Logout.js"></script>
</body>

</html>