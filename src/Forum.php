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
   <link rel="stylesheet" href="assets/css/Footer-Basic.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
   <link rel="stylesheet" href="assets/css/Modal-Criar-Topico.css">
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
         <div data-bss-parallax-bg="true" style="background-image: url(assets/img/Background-network.png); background-position: center; background-size: contain;">
            <h1 style="color: #F8AB02; margin: 40px;">Fórum</h1>
            <p style="color: #F2F2F2; margin: 40px; font-size: 18px; text-align: justify">Compartilhe ideias e conecte-se a outros egressos!</p>
         </div>

         <!-- Start: Botões -->
         <div class="row" style="margin-left: 30px; padding-top: 14px;">
            <div class="col-md-8">
               <form method="GET" action="" id="form-busca">
                  <div class="form-group">
                     <div class="input-group">
                        <input type="text" class="form-control" style="border-radius:0px"
                           placeholder="Busque tópicos por título, conteúdo ou assunto" name="termo-busca"
                           id="termo-busca">
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
               <button type="button" class="btn btn-success" style="border-radius:0px" data-bs-toggle="modal"
               data-bs-target="#modal-novo-topico" id="#btn-novo-topico">
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
         <div class="modal fade" id="modal-novo-topico" tabindex="-1" role="dialog"
            aria-labelledby="modal-novo-topicoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="modal-novo-topicoLabel">Criar Novo Tópico</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <form method="POST" action="" id="form-criar-topico">
                        <div class="form-group">
                           <label for="assunto">Assunto:</label>
                           <select class="form-control" id="assunto" name="assunto" required>
                              <option value="">Selecione o assunto do tópico</option>
                              <optgroup label="Ciência da Computação">
                                 <option value="Algoritmos e Estruturas de Dados">Algoritmos e Estruturas de Dados
                                 </option>
                                 <option value="Arquitetura de Computadores">Arquitetura de Computadores</option>
                                 <option value="Inteligência Artificial">Inteligência Artificial</option>
                                 <option value="Redes de Computadore">Redes de Computadores</option>
                                 <option value="Segurança da Informação">Segurança da Informação</option>
                                 <option value="Sistemas Distribuídos">Sistemas Distribuídos</option>
                                 <option value="Teoria da Computação">Teoria da Computação</option>
                              </optgroup>
                              <optgroup label="Engenharia de Software">
                                 <option value="Métodos Ágeis">Métodos Ágeis</option>
                                 <option value="Padrões de Projeto">Padrões de Projeto</option>
                                 <option value="Processos de Desenvolvimento de Software">Processos de Desenvolvimento
                                    de Software</option>
                                 <option value="Qualidade de Software">Qualidade de Software</option>
                                 <option value="Teste de Software">Teste de Software</option>
                              </optgroup>
                              <optgroup label="Banco de Dados">
                                 <option value="Administração de Banco de Dados">Administração de Banco de Dados
                                 </option>
                                 <option value="Modelagem de Dados">Modelagem de Dados</option>
                                 <option value="SQL e Bancos de Dados Relacionais">SQL e Bancos de Dados Relacionais
                                 </option>
                                 <option value="Bancos de Dados NoSQL">Bancos de Dados NoSQL</option>
                              </optgroup>
                              <optgroup label="Outros assuntos">
                                 <option value="Memórias">Memórias</option>
                                 <option value="Outros">Outros</option>
                              </optgroup>
                           </select>

                        </div>
                        <div class="form-group">
                           <label for="titulo">Título:</label>
                           <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="form-group">
                           <label for="conteudo">Conteúdo:</label>
                           <textarea name="conteudo" id="conteudo"></textarea>
                        </div>
                        <input type="hidden" name="acao" value="criar">
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 0px">Fechar</button>
                           <button type="submit" class="btn btn-primary" id="btn-criar-topico" style="border-radius: 0px">Criar Tópico</button>
                        </div>
                     </form>
                  </div>

               </div>
            </div>
         </div>
         <!-- End: Modal Novo Tópico -->

         <!-- Start: Resultados -->
         <div id="resultados-busca" class="resultados-busca" style="margin:40px; margin-bottom: 185px;">
            <br/>
         </div>
         
         <!-- End: Resultados -->

         <!-- Modal de sucesso -->
         <div class="modal" id="modal-sucesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Sucesso!</h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     O tópico foi criado com sucesso.
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  </div>
               </div>
            </div>
         </div>

         <!-- End: Modal de Sucesso -->

         <!-- Modal de falha -->
         <div class="modal" id="modal-falha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Falha!</h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     Ocorreu um erro ao criar o tópico. 
                     <br/>
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
   

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
   <script src="assets/js/jquery.blockUI.js"></script>
   <script src="assets/js/bs-init.js"></script>    
   <script src="assets/js/Logout.js"></script>
   <script src="assets/js/Busca-Topico.js"></script>
   <script src="assets/js/Criar-Topico.js"></script>
   <script src="assets/js/Forum-Suave.js"></script>
   <!-- habilita a inserção de textos Markdown -->
   <script>var simplemde = new SimpleMDE({ element: document.getElementById("conteudo") });</script>

</body>

</html>