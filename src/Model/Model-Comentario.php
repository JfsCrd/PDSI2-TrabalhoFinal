<?php

require_once("Model-DataBase.php");

//inserir comentário
function criarComentario($comentario, $id_usuario, $data, $id_topico)
{
   include("Model-DataBase.php");

   $sql = "INSERT INTO comentario (comentario, data, fk_topico, fk_usuario) 
            VALUES ('$comentario', '$data', '$id_topico', '$id_usuario');";

   $command = mysqli_query($conn, $sql);

   return $command;

}

?>