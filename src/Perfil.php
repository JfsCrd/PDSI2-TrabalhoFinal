<?php

session_start();
$usuario = $_SESSION['usuario'];

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
   header('Location: login.html');
   exit();
}

// Verifica se o parâmetro 'url' está definido
if (isset($_GET['usuario'])) {
   include("Model/Model-Usuario.php");
   $url = $_GET['usuario'];

   // Chamada à função getUsuarioURL() para obter os dados do usuário
   $usuario = getUsuarioURL($url);

   if (!$usuario) {
      echo "nao existe o usuario buscado";
      header('Location: Busca.php');
      exit();
   }
} else {
   echo "a url não foi especificada";
   header('Location: Busca.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <title>
      <?php echo $usuario['nome'] . ' ' . $usuario['sobrenome']; ?> | ALUMNI FACOM
   </title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" href="assets/css/Footer-Basic.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
   <link rel="stylesheet" href="assets/css/Forum.css">
   <link rel="stylesheet" href="assets/css/Perfil.css">
   <link rel="stylesheet" href="assets/css/Block-Ui.css">


</head>

<body style="overflow-x: hidden;">

   <nav class="navbar navbar-light navbar-expand-md" style="background: #f2f2f2; font-family: Roboto;">
      <div class="container-fluid">
         <a class="navbar-brand disabled" style="margin-left: 45px; cursor: default;">ALUMNI FACOM UFU</a>
         <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span
               class="visually-hidden">Mudar navegação</span><span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navcol-1" style="background: #f2f2f2;">
            <ul class="navbar-nav">
               <li class="nav-item"><a class="nav-link" href="Alumni.php">Início</a></li>
               <li class="nav-item"><a class="nav-link" href="Busca.php" style="color:#212B58">Buscar</a></li>
               <li class="nav-item"><a class="nav-link" href="Forum.php">Fórum</a></li>
               <li class="nav-item"><a class="nav-link" href="Oportunidades.php">Oportunidades</a></li>
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
                     <li><a class="dropdown-item" href="Perfil.php?usuario=<?php echo $_SESSION['usuario'] ?>">Meu Perfil</a></li>
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

         <div class="parallax-bg">

            <div class="row" style="margin: 40px;">
               <div class="col-md-2" style="margin: auto">
                  <?php $imagemBytes = $usuario['foto']; ?>
                  <img src="data:image/jpeg;base64, <?php echo base64_encode($imagemBytes); ?>" class="img"
                     alt="Foto do usuário">
               </div>
               <div class="col-md-10" style="padding-left: 20px;">
                  <div class="row">
                     <h1 style="color: #F8AB02; margin-top: 40px">
                        <?php echo $usuario['nome'] . ' ' . $usuario['sobrenome']; ?>
                     </h1>
                     <p style="color:#f2f2f2; font-size: 18px; text-align: justify; margin-right: 10px;">
                        <?php echo $usuario['resumo']; ?>
                     </p>
                  </div>

                  <div class="row" style="margin-top: 40px; margin-left: 150px;">
                     <div class="col md-4">
                        <div class="icon-div" style="text-align: right;">
                           <i class="fas fa-map-marker-alt icon-icon"></i>
                           <span class="icon-name">
                              <?php echo $usuario['cidade']; ?>
                           </span>
                        </div>
                     </div>
                     <div class="col md-4">
                        <div class="icon-div" style="text-align: center;">
                           <i class="fas fa-envelope icon-icon"></i>
                           <span class="icon-name">
                              <?php echo $usuario['email_ufu']; ?>
                           </span>
                        </div>
                     </div>
                     <div class="col md-4">
                        <div class="icon-div" style="text-align: left;">
                           <i class="fas fa-paperclip icon-icon"></i>
                           <span class="icon-name">
                              <a href="<?php echo $usuario['rede_social_url']; ?>" target="_blank"
                                 style="text-decoration: none; color: #f2f2f2;">
                                 <?php echo $usuario['rede_social']; ?></a></span>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>


         <div class="container-fluid" style="margin: 40px;">
            <div class="row">
               <div class="col-md-12">
                  <h3>
                     Formação
                  </h3>
                  <p>
                     <strong>
                        <?php echo $usuario['formacao']; ?>
                     </strong>
                     <br>
                     <?php echo $usuario['instituicao'] . ', ' . $usuario['ano']; ?>
                  </p>
               </div>
            </div>
            <div class="row" style="margin-top:30px">
               <div class="col-md-12">
                  <h3>
                     Experiência Profissional
                  </h3>
                  <p>
                     <strong>
                        <?php echo $usuario['empresa']; ?>
                     </strong>
                     <br>
                     <?php echo $usuario['cargo']; ?>
                     <br>
                     <?php echo $usuario['descricao']; ?>
                  </p>
               </div>
            </div>
         </div>

      </div>
   </div>
   <!-- Start: Footer Basic -->
   <footer class="footer-basic" style="position:relative;padding-bottom: 15px;padding-top: 30px; margin-top:100px">
      <ul class="list-inline">
         <li class="list-inline-item"><a href="#">Início</a></li>
         <li class="list-inline-item"></li>
         <li class="list-inline-item"><a href="Institucional.html">Sobre</a></li>
         <li class="list-inline-item"></li>
         <li class="list-inline-item"><a href="Institucional.html">Política de Privacidade</a></li>
      </ul>
      <p class="copyright">FACOM | Universidade Federal de Uberlândia © 2023</p>
   </footer><!-- End: Footer Basic -->


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
   <script src="assets/js/jquery.blockUI.js"></script>
   <script src="assets/js/bs-init.js"></script>
   <script src="assets/js/Logout.js"></script>

</body>

</html>