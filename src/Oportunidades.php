<?php
session_start();
$usuario = $_SESSION['usuario'];

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}

include("Model/Model-Usuario.php");
$nome = getNome($usuario);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Oportunidades | ALUMNI FACOM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Portal.css">
    <link rel="stylesheet" href="assets/css/Oportunidades.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
                    <li class="nav-item"><a class="nav-link" href="Alumni.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="Busca.php">Busca</a></li>
                    <li class="nav-item"><a class="nav-link" href="Forum.php">Fórum</a></li>
                    <li class="nav-item"><a class="nav-link disabled" style="color:#212B58" href="#">Oportunidades</a>
                    </li>
                </ul>
                <div class="ms-auto d-flex align-items-center" style="margin-right: 10px;">
                    <div class="dropdown ms-auto">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 0%;">
                            <span>Bem-vindo,
                                <?php echo $nome['nome']; ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item"
                                    href="Perfil.php?usuario=<?php echo $_SESSION['usuario'] ?>">Meu Perfil</a></li>
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
                style="background-image: url(assets/img/background.png);background-position: center;background-size: cover;">
                <h1 style="color: #F8AB02; margin: 40px">Encontre oportunidades!</h1>
                <p style="color:#f2f2f2; margin: 40px; margin-right: 150px; font-size: 18px; text-align: justify">
                    Encontre vagas e oportunidades de emprego.</p>

            </div>

            <div class="form-group" style="margin: 40px; margin-top: 0px; padding-top: 14px;">
                <!-- Start: Campo de busca -->
                <form method="GET" action="" id="form-busca">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" style="border-radius:0px"
                                    placeholder="Busque área, título ou palavras-chave" name="termo-busca"
                                    id="termo-busca">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" class="form-control" style="border-radius:0px"
                                    placeholder="Filtre por localidade" name="termo-loc" id="termo-loc">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary" style="width: 100%; border-radius:0px">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>

            <!-- End: Campo de Busca -->

            <!-- Start: Resultados -->
            <div id="resultados-busca" style="margin:40px"> </div>
            <!-- End: Resultados -->

            <div id="creditos" style="margin: 40px; text-align: center;">
                <p>Vagas obtidas em:<a href="https://www.adzuna.com.br" style="text-decoration: none;" target="_blank">
                        Adzuna.com</a> </p>
            </div>

        </div>
    </div>

    <!-- Start: Footer Basic -->
    <footer class="footer-basic" style="position:relative;padding-bottom: 15px;padding-top: 30px;">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/Logout.js"></script>
    <script src="assets/js/Oportunidades.js"></script>

</body>

</html>