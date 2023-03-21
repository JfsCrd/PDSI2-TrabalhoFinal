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

    $acao = filter_input(INPUT_POST, "acao");

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
    }
        
    //Login

    // elseif($action_form === 'login'){
    //     $return_login = loginUser($login_email, $login_pass);

    //     if ($return_login != false) {
    //         $_SESSION['s_idUser'] = $return_login['idUser'];
    //         $_SESSION['s_name'] = $return_login['Name'];
    //         $_SESSION['s_date'] = $return_login['Birth'];
    //         $_SESSION['s_email'] = $return_login['Email'];
    //         $_SESSION['s_telephone'] = $return_login['Telephone'];
    //         $_SESSION['s_pass'] = $return_login['Password'];
    //         $_SESSION['s_rank'] = $return_login['Rank'];
    //         $_SESSION['s_full_adress'] = $return_login['Adress'];

    //         if ($_SESSION['s_rank'] == 1)
    //             echo "<script type='text/javascript'>alert('Login sucess! Wellcome');window.location.href = '../View/Home-User.php';</script>";

    //         else {
    //             echo "<script type='text/javascript'>alert('Login sucess');window.location.href = '../View/Home-Adm.php';</script>";
    //         }
    //     }
    //     else{
    //         echo "<script type='text/javascript'>alert('Login fail.');window.location.href ='../View/Register.php';</script>";
    //     }

    // }

}



?>