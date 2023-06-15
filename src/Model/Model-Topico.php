<?php

require_once("Model-DataBase.php");

//inserir topico
function criarTopico($assunto, $data, $conteudo, $titulo, $id_usuario, $url_topico)
{
   include("Model-DataBase.php");

   // Obtém o ultimo id inserido
   $sql = 'SELECT MAX(id_topico) as ultimo_id from topico';
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);

   // Incrementa o último id inserido
   $id_topico = $row['ultimo_id'] + 1;
   
   // Altera a url para o padrão
   $url_topico = $id_topico . '-' . $url_topico;

   $sql = "INSERT INTO topico (assunto, conteudo, data, fk_usuario, titulo, url) 
            VALUES ('$assunto', '$conteudo', '$data', '$id_usuario', '$titulo', '$url_topico');";

   $command = mysqli_query($conn, $sql);

   $return = array(
      'success' => true,
      'url' => $url_topico
   ); 

   return $return;

}

// Busca URL 
function getTopicoURL($url)
{

   include("Model-DataBase.php");

   // Consulta o banco para obter o tópico com base na URL
   $query = "SELECT topico.titulo, topico.id_topico, topico.data, topico.conteudo, usuario.nome, usuario.sobrenome, usuario.foto
               FROM topico 
               JOIN usuario on topico.fk_usuario = usuario.id_usuario
               WHERE url = '$url'";

   $result = mysqli_query($conn, $query);

   // Verifique se a consulta foi bem-sucedida
   if ($result && mysqli_num_rows($result) > 0) {
      // Obtém os dados do tópico do resultado da consulta
      $topico = mysqli_fetch_assoc($result);
      return $topico;
   } else if ($url === null)
      return null;
   else
      return null; // Tópico não encontrado

}

?>