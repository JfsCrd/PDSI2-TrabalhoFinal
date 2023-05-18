<?php

session_start();

include("../Model/Model-Topico.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $usuario = $_SESSION['usuario'];

   //infos do post
   $assunto = filter_input(INPUT_POST, "assunto");
   $titulo = filter_input(INPUT_POST, "titulo");
   $conteudo = filter_input(INPUT_POST, "conteudo");

   $data = date("Y-m-d");

   $acao = $_POST['acao'];
   //chamando a função de registro

   if ($acao === 'criar') {

      $sql = "SELECT id_acesso
               FROM acesso 
               WHERE usuario = '$usuario'";

      $resultado = mysqli_query($conn, $sql);
      $linha = mysqli_fetch_assoc($resultado);

      if ($linha) {
         $id_acesso = $linha['id_acesso'];

         $sql = "SELECT id_usuario
            FROM usuario
            WHERE fk_acesso = '$id_acesso'";

         $resultado = mysqli_query($conn, $sql);
         $linha = mysqli_fetch_assoc($resultado);

         if ($linha){
            $id_usuario = $linha['id_usuario'];
            echo 'success';
            $return_registro = criarTopico($assunto, $data, $conteudo, $titulo, $id_usuario);
        } 
        else
         echo 'error';
      }
   
      else 
         echo 'error';
   }
   else
      echo 'Nenhuma ação definida';
   
}

?>