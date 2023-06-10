<?php

    require_once ("Model-DataBase.php");

    // Inserir Usuário
    function registraUsuario ($nome, $sobrenome, $matricula, $cpf, $data_nasc, $email_pessoal, $email_ufu, $telefone, $pais, $estado, $cidade, $cep, $rua, $numero, $bairro, $complemento, $formacao, $instituicao, $conclusao, $titulo, $cargo, $empresa, $area, $salario, $local, $descricao, $senha, $foto, $resumo, $rede, $rede_url){ 
        include ("Model-DataBase.php");

        $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO contato (email_pessoal, email_ufu, telefone, pais, estado, cidade, rua,
                    numero, bairro, cep, complemento, rede_social, rede_social_url) VALUES ('$email_pessoal', '$email_ufu', '$telefone', '$pais', '$estado', '$cidade', '$rua', $numero, '$bairro', '$cep', '$complemento', '$rede', '$rede_url');";

        mysqli_query($conn, $sql);
        $id_contato = mysqli_insert_id($conn);

        $sql = "INSERT INTO experiencia_concluida (formacao, instituicao, conclusao, titulo) VALUES ('$formacao', '$instituicao', '$conclusao', '$titulo');";
        
        mysqli_query($conn, $sql);
        $id_experiencia_concluida = mysqli_insert_id($conn);

        $sql = "INSERT INTO experiencia_profissional (cargo, empresa, area, salario, local, descricao) VALUES ('$cargo', '$empresa', '$area', $salario, '$local', '$descricao');";
        
        mysqli_query($conn, $sql);
        $id_experiencia_profissional = mysqli_insert_id($conn);

        $sql = "INSERT INTO acesso (usuario, senha) VALUES ('$matricula', '$senha_cripto');";
        
        mysqli_query($conn, $sql);
        $id_acesso = mysqli_insert_id($conn);

        $sql = "INSERT INTO usuario (id_usuario, cpf, nome, sobrenome, data_nascimento, fk_contato, fk_experiencia_concluida, fk_experiencia_profissional, fk_acesso, resumo, foto)
                VALUES ('$matricula', '$cpf', '$nome', '$sobrenome', '$data_nasc', $id_contato, $id_experiencia_concluida, $id_experiencia_profissional, $id_acesso, '$resumo', '$foto');";

        
        $command = mysqli_query($conn, $sql);

        return $command;

    }

    function editarUsuario($nome, $sobrenome, $data_nasc, $foto, $resumo, $email_pessoal, $telefone, $pais, $estado, $cidade, $cep, $rua, $numero, $bairro, $complemento, $formacao, $instituicao, $conclusao, $titulo, $cargo, $empresa, $area, $salario, $local, $descricao, $rede, $rede_url, $id, $fk_contato, $fk_exp_acad, $fk_exp_prof){

        include ("Model-DataBase.php");
        $count = 0;

        # USUÁRIO
        if($foto!=''){        
            $sql = "UPDATE usuario
                    SET nome = '$nome', sobrenome = '$sobrenome', data_nascimento = '$data_nasc', foto = '$foto', resumo = '$resumo'
                    WHERE usuario.id_usuario = '$id'";
    
            $command = mysqli_query($conn, $sql);
    
            if($command)
                $count++;
            
        }

        else{
            $sql = "UPDATE usuario
                    SET nome = '$nome', sobrenome = '$sobrenome', data_nascimento = '$data_nasc', resumo = '$resumo'
                    WHERE usuario.id_usuario = '$id'";
    
            $command = mysqli_query($conn, $sql);
    
            if($command)
                $count++;
        }



        # CONTATO
        $sql = "UPDATE contato
                SET telefone = '$telefone', pais = '$pais', estado = '$estado', cidade = '$cidade', cep = '$cep', rua = '$rua', numero = '$numero', bairro = '$bairro', complemento = '$complemento', email_pessoal = '$email_pessoal', rede_social = '$rede', rede_social_url = '$rede_url'
                WHERE id_contato = '$fk_contato'";

        $command = mysqli_query($conn, $sql);

        if($command)
            $count++;

        # ACADÊMICA
        $sql = "UPDATE experiencia_concluida
        SET conclusao = '$conclusao', formacao = '$formacao', instituicao = '$instituicao', titulo = '$titulo'
        WHERE id_experiencia_concluida = '$fk_exp_acad'";

        $command = mysqli_query($conn, $sql);

        if($command)
            $count++;

        # PROFISSINAL
        $sql = "UPDATE experiencia_profissional
                SET area = '$area', cargo = '$cargo', descricao = '$descricao', empresa = '$empresa', local = '$local', salario = '$salario'
                WHERE id_experiencia_profissional = '$fk_exp_prof'";

        $command = mysqli_query($conn, $sql);

        if($command)
            $count++;

        if($command == 4)
            return true;
        
        else
            return 'error';
        
    }

    // Login
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

    // Busca Usuarios
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

    // Get nome do Usuário logado
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

    // Get ID do Usuário logado
    function getId($usuario){

        include ("Model-DataBase.php");

        $query = "SELECT id_usuario 
                  FROM usuario 
                  WHERE id_usuario = '$usuario'";

        $result = mysqli_query($conn, $query);

        $id = mysqli_fetch_assoc($result);
        return $id;
        
    }

    // Get Usuario
    function getUsuario($id){

        include ("Model-DataBase.php");

        $query = "SELECT *
                FROM usuario
                JOIN acesso ON acesso.id_acesso = usuario.fk_acesso
                JOIN contato ON contato.id_contato = usuario.fk_contato
                JOIN experiencia_concluida ON experiencia_concluida.id_experiencia_concluida = usuario.fk_experiencia_concluida
                JOIN experiencia_profissional ON experiencia_profissional.id_experiencia_profissional = usuario.fk_experiencia_profissional
                WHERE acesso.usuario = '$id'";

        $result = mysqli_query($conn, $query);

        $usuario = mysqli_fetch_assoc($result);
        return $usuario;

    }

    function getFksUsuario($id){

        include ("Model-DataBase.php");

        $query = "SELECT fk_contato, fk_experiencia_concluida, fk_experiencia_profissional 
                  FROM usuario 
                  WHERE id_usuario = '$id'";

        $result = mysqli_query($conn, $query);

        $fks = mysqli_fetch_assoc($result);
        return $fks;


    }

?>