<?php

    require_once ("Model-DataBase.php");

    //inserir user
    function registraUsuario ($nome, $sobrenome, $cpf, $data_nasc, $email_pessoal, $email_ufu, $telefone, $pais, $estado, $cidade, $cep, $rua, $numero, $bairro, $complemento, $formacao, $instituicao, $conclusao, $titulo, $formacaoEmCurso, $instituicaoEmCurso, $incio, $conclusaoEmCurso, $tituloEmCurso, $cargo, $empresa, $area, $salario, $local, $descricao, $usuario, $senha){ 
        include ("Model-DataBase.php");

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

        $sql = "INSERT INTO acesso (usuario, senha) VALUES ('$usuario', '$senha');";
        
        mysqli_query($conn, $sql);
        $id_acesso = mysqli_insert_id($conn);

        $sql = "INSERT INTO usuario (id_usuario, nome, sobrenome, data_nascimento, fk_contato, fk_experiencia_concluida, fk_experiencia_cursando, fk_experiencia_profissional, fk_acesso)
                VALUES ('$cpf', '$nome', '$sobrenome', '$data_nasc', $id_contato, $id_experiencia_concluida, $id_experiencia_cursando, $id_experiencia_profissional, $id_acesso);";

        $command = mysqli_query($conn, $sql);

        return $command;

    }

    //login usuário
    function loginUser($email, $pass){ //login

        include ("Model-DataBase.php");
        
        $query = "SELECT * FROM user WHERE email = '$email' and password = '$pass';";

        $command = mysqli_query($conn, $query);

        $num_rows = mysqli_num_rows($command);

        if($num_rows>= 1){
            $user = mysqli_fetch_assoc($command); //transform dates in arrayss
            return $user; 
        }
        
        else            
            return false;

    }
 

?>