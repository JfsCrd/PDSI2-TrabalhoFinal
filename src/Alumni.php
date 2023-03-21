<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
</head>

<body style="color: #839eef;background: url(&quot;assets/img/background.png&quot;), #212b58;">

    <nav class="navbar navbar-light navbar-expand-md" style="background: #f2f2f2;font-family: Roboto;">
        <div class="container-fluid"><a class="navbar-brand" href="#" style="margin-left: 45px;">ALUMNI FACOM
                UFU</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Mudar navegação</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="background: #f2f2f2;">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Alumni.php">Início</a></li>
                </ul><a class="btn btn-danger btn-sm ms-auto" role="button" id='botao-logout' href="Login.html">Sair</a>
                </ul>
            </div>
        </div>
    </nav>

    <div style="height: 600px; font-family: Roboto;">
        <div class="card" style="width: 18rem; margin-top: 40px;margin-left:40px">
            <div class="card-body">
                <p class="card-text">Em Manutenção</p>
            </div>
        </div>
    </div>




    <!-- Start: Footer Basic -->
    <footer class="footer-basic" style="padding-bottom: 15px;padding-top: 30px;">
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