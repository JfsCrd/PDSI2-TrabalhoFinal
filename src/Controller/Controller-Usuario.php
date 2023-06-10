<?php

session_start();

include("../Model/Model-Usuario.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //infos
    $nome = filter_input(INPUT_POST, "nome");
    $sobrenome = filter_input(INPUT_POST, "sobrenome");
    $cpf = filter_input(INPUT_POST, "cpf");
    $data_nasc = filter_input(INPUT_POST, "nascimento");
    $matricula = filter_input(INPUT_POST, "matricula");

    //contato
    $email_pessoal = filter_input(INPUT_POST, "emailPessoal");
    $email_ufu = filter_input(INPUT_POST, "emailPessoal");
    $telefone = filter_input(INPUT_POST, "telefone");
    $pais = filter_input(INPUT_POST, "pais");
    $estado = filter_input(INPUT_POST, "estado");
    $cidade = filter_input(INPUT_POST, "cidade");
    $cep = filter_input(INPUT_POST, "cep");
    $rua = filter_input(INPUT_POST, "rua");
    $numero = filter_input(INPUT_POST, "numero");
    $bairro = filter_input(INPUT_POST, "bairro");
    $complemento = filter_input(INPUT_POST, "complemento");

    //exp academica
    $formacao = filter_input(INPUT_POST, "formacao");
    $instituicao = filter_input(INPUT_POST, "instituicao");
    $conclusao = filter_input(INPUT_POST, "conclusao");
    $titulo = filter_input(INPUT_POST, "titulo");


    //exp profissional
    $cargo = filter_input(INPUT_POST, "cargo");
    $empresa = filter_input(INPUT_POST, "empresa");
    $area = filter_input(INPUT_POST, "area");
    $salario = filter_input(INPUT_POST, "salario");
    $local = filter_input(INPUT_POST, "local");
    $descricao = filter_input(INPUT_POST, "descricao");

    //acesso
    $usuario = filter_input(INPUT_POST, "usuario");
    $senha = filter_input(INPUT_POST, "senha");

    //login
    $user = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');

    //social
    $resumo = filter_input(INPUT_POST, 'resumo');
    $rede = filter_input(INPUT_POST, 'rede');
    $rede_url = filter_input(INPUT_POST, 'rede_url');

    $acao = $_POST['acao'];
    $id_usuario = filter_input(INPUT_POST, 'id_usuario');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //chamando a função de registro
        if ($acao === 'registrar') {

            $foto_loc = $_FILES['foto']['tmp_name'];
            $foto_tam = $_FILES['foto']['size'];

            if ($foto_loc != "none" && !empty($foto_loc)) {
                $fp = fopen($foto_loc, "rb");
                $foto = fread($fp, $foto_tam);
                $foto = addslashes($foto);
                fclose($fp);
            } else
                $foto = '';

            $return_registro = registraUsuario($nome, $sobrenome, $matricula, $cpf, $data_nasc, $email_pessoal, $email_ufu, $telefone, $pais, $estado, $cidade, $cep, $rua, $numero, $bairro, $complemento, $formacao, $instituicao, $conclusao, $titulo, $cargo, $empresa, $area, $salario, $local, $descricao, $senha, $foto, $resumo, $rede, $rede_url);

            if ($return_registro) {
                echo "<script language ='javascript' type='text/javascript'> alert('Successo! Bem vindo!'); window.location.href='/Alumni.php' </script>";
                header('Location: /Alumni.php');
            } else {
                echo "<script language ='javascript' type='text/javascript'> alert('Usuário já cadastrado! Faça login para acessar a plataforma.');</script>";
                header('Location: /Login.html');
            }
        } else if ($acao === 'login') {
            $return_login = login($user, $pass);
            if ($return_login === 1) {
                $_SESSION['usuario'] = $user;
                echo 'sucesso';

            } else
                echo 'falha';

        } else if ($acao === 'update') {
            $foto_loc = $_FILES['foto']['tmp_name'];
            $foto_tam = $_FILES['foto']['size'];

            if ($foto_loc != "none" && !empty($foto_loc)) {
                $fp = fopen($foto_loc, "rb");
                $foto = fread($fp, $foto_tam);
                $foto = addslashes($foto);
                fclose($fp);
            } else
                $foto = '';

            $fk = getFksUsuario($id_usuario);
            $return_update = editarUsuario($nome, $sobrenome, $data_nasc, $foto, $resumo, $email_pessoal, $telefone, $pais, $estado, $cidade, $cep, $rua, $numero, $bairro, $complemento, $formacao, $instituicao, $conclusao, $titulo, $cargo, $empresa, $area, $salario, $local, $descricao, $rede, $rede_url, $id_usuario, $fk['fk_contato'], $fk['fk_experiencia_concluida'], $fk['fk_experiencia_profissional']);

            if ($return_update === true)
                echo 'success';
            else
                echo 'falha';
        }
    }

}
?>