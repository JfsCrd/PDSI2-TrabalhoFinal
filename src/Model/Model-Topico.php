<?php

require_once ("Model-DataBase.php");
//inserir topico
function criarTopico($assunto, $data, $conteudo, $titulo, $id_usuario){ 
   include ("Model-DataBase.php");

   $sql = "INSERT INTO topico (assunto, conteudo, data, fk_usuario, titulo) 
            VALUES ('$assunto', '$conteudo', '$data', '$id_usuario', '$titulo');";

   $command = mysqli_query($conn, $sql);

   return $command;

}

?>