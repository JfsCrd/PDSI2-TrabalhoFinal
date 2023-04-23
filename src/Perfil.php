<?php
session_start();
$usuario = $_SESSION['usuario'];

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}
include("Model/Model-DataBase.php");
// Define a consulta SQL
$sql = "SELECT *
        FROM usuario
        JOIN acesso ON acesso.id_acesso = usuario.fk_acesso
        JOIN contato ON contato.id_contato = usuario.fk_contato
        JOIN experiencia_concluida ON experiencia_concluida.id_experiencia_concluida = usuario.fk_experiencia_concluida
        JOIN experiencia_cursando ON experiencia_cursando.id_experiencia_cursando = usuario.fk_experiencia_cursando
        JOIN experiencia_profissional ON experiencia_profissional.id_experiencia_profissional = usuario.fk_experiencia_profissional
        WHERE acesso.usuario = ?";

// Prepara a consulta SQL
$stmt = mysqli_prepare($conn, $sql);

// Verifica se a preparação foi bem sucedida
if (!$stmt) {
    die("Falha na preparação da consulta: " . mysqli_error($conn));
}

// Atribui os valores aos parâmetros da consulta
$id = $_SESSION['usuario'];
mysqli_stmt_bind_param($stmt, "i", $id);

// Executa a consulta
if (mysqli_stmt_execute($stmt)) {
    // Recupera os resultados da consulta
    $result = mysqli_stmt_get_result($stmt);

    // Recupera o usuário da tabela
    $usuario = mysqli_fetch_assoc($result);
} else {
    die("Falha na execução da consulta: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>MEU PERFIL | ALUMNI FACOM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Portal.css">
    <link rel="stylesheet" href="assets/css/Alterar-Dados.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
</head>

<body>

    <nav class="navbar navbar-light navbar-expand-md" style="background: #f2f2f2; font-family: Roboto;">
        <div class="container-fluid"><a class="navbar-brand" href="#" style="margin-left: 45px;">ALUMNI FACOM
                UFU</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span
                    class="visually-hidden">Mudar navegação</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="background: #f2f2f2;">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Alumni.php">Início</a></li>
                </ul>
                <div class="ms-auto d-flex align-items-center" style="margin-right: 10px;">
                    <div class="dropdown ms-auto">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span>Bem-vindo,
                                <?php echo $_SESSION["usuario"]; ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item disabled" href="#">Meu perfil</a></li>
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
                <h1 style="color: #F8AB02; margin: 40px">Meu Perfil</h1>
            </div>

            <div class="form" style="margin-left: 40px; margin-right:40px">
                <form method="POST" action="Controller/Controller-Usuario.php" id="formUpdate">
                    <!-- Start: Dados Básicos -->
                    <div class='form-group'>
                        <h2>Informações Pessoais</h2>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="inputNome">Nome</label>
                                <input name="nome" type="text" class="form-control" 
                                    value="<?php echo $usuario['nome']; ?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-5">
                                <label for="inputCpf">Sobrenome</label>
                                <input name="sobrenome" type="text" class="form-control"
                                value="<?php echo $usuario['sobrenome'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-3">
                                <label for="inputMatricula">Matricula</label>
                                <input type="text" class="form-control" name="matricula" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="inputNascimento">Data de Nascimento</label>
                                <input name="nascimento" type="date" class="form-control" value="<?php echo $usuario['data_nascimento'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-2">
                                <label for="inputTelefone">Telefone</label>
                                <input type="phone" class="form-control" name="telefone" value="<?php echo $usuario['telefone'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmailPessoal">E-mail pessoal</label>
                                <input type="email" class="form-control" name="emailPessoal" value="<?php echo $usuario['email_pessoal'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmailUfu">E-mail @ufu</label>
                                <input type="email" class="form-control" name="emailUfu" id="emailUfu" value="<?php echo $usuario['email_ufu'];?>" disabled>
                            </div>
                        </div>

                        </br>
                        <h2>Endereço</h2>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="inputPais">País</label>
                                <select name="pais" class="form-control">
                                    <option selected><?php echo $usuario['pais'];?></option>
                                    <option name="br">Brasil</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label id="inputEstado" for="inputEstado">Estado</label>
                                <select name="estado" class="form-control">
                                    <option selected><?php echo $usuario['estado'];?></option>
                                    <option name="mg">Minas Gerais</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="inputCidade">Cidade</label>
                                <select name="cidade" class="form-control" >
                                    <option selected><?php echo $usuario['cidade'];?></option>
                                    <option name="br">Monte Carmelo</option>
                                    <select id="cidade" class="form-control"></select>
                            </div>
                            <div class="col-md-3">
                                <label for="inputCep">CEP</label>
                                <input name="cep" type="number" class="form-control" value="<?php echo $usuario['cep'];?>" onchange="campoAlterado(this);">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="inputRua">Rua</label>
                                <input name="rua" type="text" class="form-control" value="<?php echo $usuario['rua'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-4">
                                <label for="inputBairro">Bairro</label>
                                <input name="bairro" type="text" class="form-control" value="<?php echo $usuario['bairro'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-1">
                                <label for="inputNumero">Número</label>
                                <input name="numero" type="text" class="form-control" value="<?php echo $usuario['numero'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-2">
                                <label for="inputComplemento">Complemento</label>
                                <input name="complemento" type="text" class="form-control" value="<?php echo $usuario['complemento'];?>" onchange="campoAlterado(this);">
                            </div>
                        </div>
                        </br>
                    </div>
                    <!-- End: Dados Básicos -->

                    <!-- Start: Experiência Acadêmica -->
                    <div>
                        <h2>Experiência Acadêmica</h2>
                        <h3 style="margin-top: 20px;">Última Experiência Concluída</h3>
                        <div class="row mb-3" id="v-pills-academica2">
                            <div class="col-md-4">
                                <label for="inputCurso">Formação</label>
                                <input name="formacao" type="text" class="form-control" value="<?php echo $usuario['formacao'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-8">
                                <label for="inputInstituicao">Instituição</label>
                                <input name="instituicao" type="text" class="form-control" value="<?php echo $usuario['instituicao'];?>" onchange="campoAlterado(this);">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="inputConclusao">Conclusão</label>
                                <input name="conclusao" type="date" class="form-control" value="<?php echo $usuario['conclusao'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-10">
                                <label for="inputTitulo">Título</label>
                                <select name="titulo" class="form-control" >
                                <option selected><?php echo $usuario['titulo'];?></option>
                                    <option name="bacharel">Bacharelado</option>
                                    <select name="titulo" class="form-control"></select>
                            </div>
                        </div>
                        </br>
                        <h3 style="margin-top: 20px;">Experiência em Curso</h3>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="inputCurso">Formação</label>
                                <input name="formacaoEmCurso" type="text" class="form-control" value="<?php echo $usuario['formacao'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-8">
                                <label for="inputInstituicao">Instituição</label>
                                <input name="instituicaoEmCurso" type="text" class="form-control" value="<?php echo $usuario['instituicao'];?>" onchange="campoAlterado(this);">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="inputIncioEmCurso">Início</label>
                                <input name="inicio" type="date" class="form-control" value="<?php echo $usuario['data_inicio'];?>"  onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-3">
                                <label for="inputConclusaoEmCurso">Previsão de Conclusão</label>
                                <input name="conclusaoEmCurso" type="date" class="form-control" value="<?php echo $usuario['data_fim'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-7">
                                <label for="inputTituloEmCurso">Título</label>
                                <select name="tituloEmCurso" class="form-control" >
                                <option selected><?php echo $usuario['experiencia_cursando.titulo'];?></option>
                                    <option name="bacharelEmCurso">Bacharelado</option>
                                    <select name="tituloEmCurso" class="form-control"></select>
                            </div>
                        </div>
                        </br>
                    </div>
                    <!-- End: Experiência Acadêmica -->

                    <!-- Start: Experiência Profissinal -->
                    <div>
                        <h2 id="profissional" style="margin-top: 20px;">Experiência Profissional</h2>
                        <h3 style="margin-top: 20px;">Última Experiência Profissional</h3>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="inputCargo">Cargo</label>
                                <input name="cargo" type="text" class="form-control" value="<?php echo $usuario['cargo'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmpresa">Empresa</label>
                                <input name="empresa" type="text" class="form-control" value="<?php echo $usuario['empresa'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-4">
                                <label for="inputArea">Área</label>
                                <input name="area" type="text" class="form-control" value="<?php echo $usuario['area'];?>" onchange="campoAlterado(this);">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="inputSalario">Salário</label>
                                <input name="salario" type="number" class="form-control" value="<?php echo $usuario['salario'];?>" onchange="campoAlterado(this);">
                            </div>
                            <div class="col-md-10">
                                <label for="inputLocalizao">Local</label>
                                <input name="local" type="text" class="form-control" value="<?php echo $usuario['local'];?>" onchange="campoAlterado(this);">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="inputDescricao">Descrição</label>
                                <textarea class="form-control" name="descricao" row mb-3s="3" onchange="campoAlterado(this);"><?php echo $usuario['descricao'];?></textarea>
                            </div>
                        </div>
                        </br>
                    </div>
                    <!-- End: Experiência Profissinal -->

                    <!-- Start: Acesso -->
                    <div>
                        <h2 id="acesso" style="margin-top: 20px;">Alterar Senha</h2>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="inputSenhaAtual">Senha Atual</label>
                                <input name="senhaAtual" id="senhaAtual" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="inputSenhaNova" >Nova Senha</label>
                                <input name="senhaNova" type="password" class="form-control" placeholder="12345">
                            </div>
                            <div class="col-md-3">
                                <label for="inputSenhaNova2" >Confirme a senha</label>
                                <input name="senhaNova2" type="password" class="form-control" placeholder="12345">
                            </div>
                        </div>
                        </br>
                        <input type="hidden" name="acao" value="update">
                        <button type="submit" class="btn btn-primary"
                            style="margin-bottom: 50px;background: #212b58;border-radius: 0px;border-color: #212b58;">Atualizar Dados</button>
                    </div>
                    <!-- End: Acesso -->
                </form>
            </div>

        </div>
    </div>
    <!-- Start: Footer Basic -->
    <footer class="footer-basic" style="padding-bottom: 15px;padding-top: 30px; position: relative;">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Início</a></li>
            <li class="list-inline-item"></li>
            <li class="list-inline-item"><a href="Institucional.html">Sobre</a></li>
            <li class="list-inline-item"></li>
            <li class="list-inline-item"><a href="Institucional.html">Política de Privacidade</a></li>
        </ul>
        <p class="copyright">FACOM | Universidade Federal de Uberlândia © 2023</p>
    </footer>
    <!-- End: Footer Basic -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
    <script src="assets/js/Logout.js"></script>
    <script src="assets/js/Alterar-Dados.js"></script>
</body>

</html>