<?php

    require_once ("Model-DataBase.php");

    //inserir user
    function registraUsuario ($nome, $sobrenome, $cpf, $data_nasc, $email_pessoal, $email_ufu, $telefone, $pais, $estado, $cidade, $cep, $rua, $numero, $bairro, $complemento, $formacao, $instituicao, $conclusao, $titulo, $formacaoEmCurso, $instituicaoEmCurso, $incio, $conclusaoEmCurso, $tituloEmCurso, $cargo, $empresa, $area, $salario, $local, $descricao, $usuario, $senha){ 
        include ("Model-DataBase.php");

        $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO contato (email_pessoal, email_ufu, telefone, pais, estado, cidade, rua,
                    numero, bairro, cep, complemento) VALUES ('$email_pessoal', '$email_ufu', '$telefone', '$pais', '$estado', '$cidade', '$rua', $numero, '$bairro', '$cep', '$complemento');";

        mysqli_query($conn, $sql);
        $id_contato = mysqli_insert_id($conn);

        $sql = "INSERT INTO experiencia_concluida (formacao, instituicao, conclusao, titulo) VALUES ('$formacao', '$instituicao', '$conclusao', '$titulo');";
        
        mysqli_query($conn, $sql);
        $id_experiencia_concluida = mysqli_insert_id($conn);
        
        $sql = "INSERT INTO experiencia_cursando (formacao, instituicao, data_inicio, data_fim, titulo) VALUES ('$formacaoEmCurso', '$instituicaoEmCurso', '$incio', '$conclusaoEmCurso', '$tituloEmCurso');";
        
        mysqli_query($conn, $sql);
        $id_experiencia_cursando = mysqli_insert_id($conn);

        $sql = "INSERT INTO experiencia_profissional (cargo, empresa, area, salario, local, descricao) VALUES ('$cargo', '$empresa', '$area', $salario, '$local', '$descricao');";
        
        mysqli_query($conn, $sql);
        $id_experiencia_profissional = mysqli_insert_id($conn);

        $sql = "INSERT INTO acesso (usuario, senha) VALUES ('$usuario', '$senha_cripto');";
        
        mysqli_query($conn, $sql);
        $id_acesso = mysqli_insert_id($conn);

        $sql = "INSERT INTO usuario (id_usuario, nome, sobrenome, data_nascimento, fk_contato, fk_experiencia_concluida, fk_experiencia_cursando, fk_experiencia_profissional, fk_acesso)
                VALUES ('$cpf', '$nome', '$sobrenome', '$data_nasc', $id_contato, $id_experiencia_concluida, $id_experiencia_cursando, $id_experiencia_profissional, $id_acesso);";

        $command = mysqli_query($conn, $sql);

        return $command;

    }

    //login usuário
    function login($user, $pass){ //login

        include ("Model-DataBase.php");

        $sql = "SELECT senha FROM acesso WHERE usuario = '$user'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $hash = $row['senha'];

        if (password_verify($pass, $hash))
            return 1;
        else 
            return 0;

    }

    // Busca Usuario 
    function getUsuarioURL($url) {

        include ("Model-DataBase.php");
        
        // Consulta o banco para obter o usuário com base na URL
        $query = "SELECT usuario.*, experiencia_profissional.*, contato.*, acesso.usuario, experiencia_concluida.*, YEAR(experiencia_concluida.conclusao) as ano
        FROM usuario
        JOIN experiencia_profissional ON experiencia_profissional.id_experiencia_profissional = usuario.fk_experiencia_profissional
        JOIN contato ON contato.id_contato = usuario.fk_contato
        JOIN acesso ON acesso.id_acesso = usuario.fk_acesso
        JOIN experiencia_concluida ON experiencia_concluida.id_experiencia_concluida = usuario.fk_experiencia_concluida
        WHERE acesso.usuario = '$url'";
    
        $result = mysqli_query($conn, $query);
    
        // Verifique se a consulta foi bem-sucedida
        if ($result && mysqli_num_rows($result) > 0) {
            // Obtém os dados do usuário do resultado da consulta
            $usuario = mysqli_fetch_assoc($result);
            return $usuario;
        } 
        
        else if($url === null)
            return null;
        
        else 
            return null; // usuário não encontrado
        
    }

    function getNome($usuario){
        include ("Model-DataBase.php");

        $query = "SELECT nome 
                  FROM usuario 
                  JOIN acesso ON acesso.id_acesso = usuario.fk_acesso 
                  WHERE acesso.usuario = '$usuario'";

        $result = mysqli_query($conn, $query);

        $nome = mysqli_fetch_assoc($result);
        return $nome;
    }

?>