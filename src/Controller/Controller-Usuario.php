<?php

session_start();

include("../Model/Model-Usuario.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //infos
    $nome = filter_input(INPUT_POST, "nome");
    $sobrenome = filter_input(INPUT_POST, "sobrenome");
    $cpf = filter_input(INPUT_POST, "cpf");
    $data_nasc = filter_input(INPUT_POST, "nascimento");

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

    //em curso
    $formacaoEmCurso = filter_input(INPUT_POST, "formacaoEmCurso");
    $instituicaoEmCurso = filter_input(INPUT_POST, "instituicaoEmCurso");
    $incio = filter_input(INPUT_POST, "incio");
    $conclusaoEmCurso = filter_input(INPUT_POST, "conclusaoEmCurso");
    $tituloEmCurso = filter_input(INPUT_POST, "tituloEmCurso");


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
    $pass = filter_input(INPUT_POST,'password');

    $acao = $_POST['acao'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //chamando a função de registro
        if($acao === 'registrar') {
            $return_registro = registraUsuario($nome, $sobrenome, $cpf, $data_nasc, $email_pessoal, $email_ufu, $telefone, $pais, $estado, $cidade, $cep, $rua, $numero, $bairro, $complemento, $formacao, $instituicao, $conclusao, $titulo, $formacaoEmCurso, $instituicaoEmCurso, $incio, $conclusaoEmCurso, $tituloEmCurso, $cargo, $empresa, $area, $salario, $local, $descricao, $usuario, $senha);

            if ($return_registro) {
                echo "<script language ='javascript' type='text/javascript'> alert('Successo! Use seus dados de login para acessar a plataforma.'); window.location.href='/Login.html' </script>";
                header('Location: /Login.html');
            } 
            
            else {
                echo "<script language ='javascript' type='text/javascript'> alert('Usuário já cadastrado! Faça login para acessar a plataforma.');</script>";
                header('Location: /Login.html');
            }
        }

        else if($acao === 'login'){
            $return_login = login($user, $pass);
            if($return_login === 1){
                echo 'sucesso';
                $_SESSION['usuario'] = $user;
            }
            else 
                echo 'falha';
            
        }
    }

}
?>