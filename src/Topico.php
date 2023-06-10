<?php

session_start();
$usuario = $_SESSION['usuario'];

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
   header('Location: login.html');
   exit();
}

// Verifica se o parâmetro 'url' está definido
if (isset($_GET['url'])) {
   include("Model/Model-Topico.php");
   $url = $_GET['url'];

   // Chamada à função getTopicoURL() para obter os dados do tópico
   $topico = getTopicoURL($url);

   if (!$topico) {
      header('Location: Forum.php');
      exit();
   }
} else {
   header('Location: Forum.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <title>
      <?php echo $topico['titulo']; ?> | ALUMNI FACOM
   </title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" href="assets/css/Footer-Basic.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
   <link rel="stylesheet" href="assets/css/Forum.css">
   <link rel="stylesheet" href="assets/css/Block-Ui.css">
   <!-- Edição de Markdown -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.css">
   <script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"></script>

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
               <li class="nav-item"><a class="nav-link" href="Busca.php">Buscar</a></li>
               <li class="nav-item"><a class="nav-link" href="Forum.php" style="color:#212B58">Fórum</a></li>
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
                     <li><a class="dropdown-item" href="Perfil.php?usuario=<?php echo $_SESSION['usuario'] ?>">Meu
                           Perfil</a></li>
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
            <h1 style="color: #F8AB02; margin: 40px">Fórum!</h1>
            <p style="color:#f2f2f2; margin-left: 40px; margin-right: 150px; font-size: 18px; text-align: justify;">Um
               espaço de conexão e troca para egressos: compartilhando experiências, insights e oportunidades.</p>
         </div>

         <!-- Start: Tópico -->
         <div class="wrapper" style="background-color: #F2F2F2; padding:1px">
            <div class="container-fluid"
               style="margin:40px;border-bottom: 1px solid #4b4c4d2c; padding-right:40px; padding-bottom: 20px;">
               <div class="row">
                  <div class="col-md-2">
                     <?php $imagemBytes = $topico['foto']; ?>
                     <img src="data:image/jpeg;base64, <?php echo base64_encode($imagemBytes); ?>" class="card-img"
                        alt="Foto do usuário" style="border-radius: 0px;">
                     <h4 style="margin-top: 10px;">
                        <?php echo $topico['nome'] . ' ' . $topico['sobrenome']; ?>
                     </h4>
                     <p style="font-size: 12px">Autor da publicação</p>
                  </div>
                  <div class="col-md-10">
                     <h3>
                        <?php echo $topico['titulo']; ?>
                     </h3>
                     <p style="font-size: 12px">Publicado em:
                        <?php echo $topico['data']; ?>
                     </p>
                     <div class="post-content" style="margin-right: 40px; overflow-x: auto;">
                        <?php echo $topico['conteudo']; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- End: Tópico -->

         <!-- Start: Resultados -->
         <div id="comentarios" style="margin:40px"></div>
         <!-- End: Resultados -->

         <!-- Start: Botão Comentar -->
         <div class="container-fluid d-flex justify-content-end align-items-center" data-bs-toggle="modal"
            data-bs-target="#modal-novo-comentario" style="margin-top: 20px;">
            <button class="btn btn-primary" style="border-radius: 0px; margin-right: 20px;"
               id="btn-comentar">Comentar</button>
         </div>
         <!-- End: Botão Comentar -->

         <!-- Start: Modal de Novo Comentário -->
         <div class="modal fade" id="modal-novo-comentario" tabindex="-1" role="dialog"
            aria-labelledby="modal-novo-comentarioLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="modal-novo-comentarioLabel">Comentar</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <form method="POST" action="" id="form-criar-comentario">
                        <div class="form-group">
                           <label for="conteudo">Comentário:</label>
                           <textarea name="conteudo" id="conteudo"></textarea>
                        </div>
                        <input type="hidden" name="acao" value="comentar">
                        <input type="hidden" name="id_post" id="id_post" value="<?php echo $topico['id_topico']; ?>">
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                              style="border-radius: 0px">Fechar</button>
                           <button type="submit" class="btn btn-primary" id="btn-criar-topico"
                              style="border-radius: 0px">Comentar</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- End: Modal Novo Comentário -->

         <!-- Modal de sucesso -->
         <div class="modal" id="modal-sucesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Sucesso!</h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     O comentário foi inserido com sucesso.
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  </div>
               </div>
            </div>
         </div>

         <!-- End: Modal de Sucesso -->

         <!-- Modal de falha -->
         <div class="modal" id="modal-falha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Falha!</h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     Ocorreu um erro ao comentar.
                     <br />
                     Tente novamente.
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  </div>
               </div>
            </div>
         </div>
         <!-- End: Modal de Falha -->

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
   <script src="assets/js/Inserir-Comentario.js"></script>
   <script src="assets/js/Exibir-Comentarios.js"></script>
   <!-- habilita a inserção de textos Markdown -->
   <script>var simplemde = new SimpleMDE({ element: document.getElementById("conteudo") });</script>

</body>

</html>