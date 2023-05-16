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
   <title>FÓRUM | ALUMNI FACOM</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="assets/css/Footer-Basic.css">
   <link rel="stylesheet" href="assets/css/Portal.css">
   <link rel="stylesheet" href="assets/css/Modal-Criar-Topico.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
               <li class="nav-item"><a class="nav-link" disabled style="cursor: default;color:#212B58">Fórum</a></li>
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
         <div>
            <h1 style="color: #F8AB02; margin: 40px">Fórum</h1>
            <p style="margin: 40px; font-size: 18px; text-align: justify">Compartilhe ideias e conecte-se a outros egressos!</p>
         </div>

         <!-- Start: Botões -->
         <div class="row" style="margin-left: 30px">
            <div class="col-md-8">
            <form method="get" action="" id="form-busca">
                  <div class="form-group">
                     <div class="input-group">
                        <input type="text" class="form-control" style="border-radius:0px"
                           placeholder="Busque tópicos por título, conteúdo ou assunto" name="termo-busca" id="termo-busca">
                        <div class="input-group-append">
                           <button type="submit" class="btn btn-primary" style="border-radius:0px">
                              <i class="fas fa-search"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-success" style="border-radius:0px" data-toggle="modal" data-target="#novoTopicoModal" id="#btn-novo-topico">
                  <i class="fas fa-plus-square"></i> Criar novo tópico
               </button>
            </div>
            <div class="col-md-2" style="margin-left:-30px;">
               <button type="button" class="btn btn-secondary" style="border-radius:0px">
                  <i class="fas fa-user"></i> Acessar meus tópicos
               </button>
            </div>
         </div>
         <!-- End: Botões -->

         <!-- Start: Modal -->
         <div class="modal fade  bd-exemple-modal-lg" id="novoTopicoModal" tabindex="-1" role="dialog" aria-labelledby="novoTopicoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="novoTopicoModalLabel">
                        <i class="fas fa-plus-square"></i> Criar Novo Tópico</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form>
                        <div class="form-group">
                           <label for="area-conhecimento">Assunto:</label>
                           <select class="form-control" id="area-conhecimento" name="area-conhecimento">
                           <option value="">Selecione o assunto do tópico</option>
                           <optgroup label="Ciência da Computação">
                              <option value="algoritmos">Algoritmos e Estruturas de Dados</option>
                              <option value="arquitetura">Arquitetura de Computadores</option>
                              <option value="inteligencia">Inteligência Artificial</option>
                              <option value="redes">Redes de Computadores</option>
                              <option value="seguranca">Segurança da Informação</option>
                              <option value="sistemas">Sistemas Distribuídos</option>
                              <option value="teoria">Teoria da Computação</option>
                           </optgroup>
                           <optgroup label="Engenharia de Software">
                              <option value="metodos">Métodos Ágeis</option>
                              <option value="padroes">Padrões de Projeto</option>
                              <option value="processos">Processos de Desenvolvimento de Software</option>
                              <option value="qualidade">Qualidade de Software</option>
                              <option value="teste">Teste de Software</option>
                           </optgroup>
                           <optgroup label="Banco de Dados">
                              <option value="administracao">Administração de Banco de Dados</option>
                              <option value="modelagem">Modelagem de Dados</option>
                              <option value="sql">SQL e Bancos de Dados Relacionais</option>
                              <option value="nosql">Bancos de Dados NoSQL</option>
                           </optgroup>
                           <optgroup label="Outros assuntos">
                              <option value="diversos">Diversos</option>
                              <option value="memorias">Memórias</option>
                              <option value="outros">Outros</option>
                           </optgroup>
                           </select>

                        </div>
                        <div class="form-group">
                           <label for="titulo">Título:</label>
                           <input type="text" class="form-control" id="titulo" name="titulo">
                        </div>
                        <div class="form-group">
                           <label for="conteudo">Conteúdo:</label>
                           <textarea name="conteudo" id="conteudo"></textarea>
                        </div>
                     </form>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                     <button type="button" class="btn btn-primary">Criar Tópico</button>
                  </div>
               </div>
            </div>
         </div>
         <!-- End: Modal Novo Tópico -->

        <!-- Start: Resultados -->

        <div id="resultados-busca" style="margin:40px"></div>

        <!-- End: Resultados -->
         

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
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/bs-init.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
   <script src="assets/js/Simple-Slider.js"></script>
   <script src="assets/js/Logout.js"></script>
   <script src="assets/js/Novo-Topico.js"></script>
   <script src="assets/js/Busca-Topico.js"></script>
   <!-- habilita a inserção de textos Markdown -->
   <script>var simplemde = new SimpleMDE({ element: document.getElementById("conteudo") });</script>

</body>

</html>