<?php

session_start();

include("../Model/Model-Topico.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   //infos do post
   $assunto = filter_input(INPUT_POST, "assunto");
   $titulo = filter_input(INPUT_POST, "titulo");
   $conteudo = filter_input(INPUT_POST, "conteudo");

   $data = date("Y-m-d");

   $acao = $_POST['acao'];
   //chamando a função de registro

   if ($acao === 'criar') {
      
      $usuario = $_SESSION['usuario'];

      $sql = "SELECT id_usuario
               FROM usuario 
               JOIN acesso ON acesso.id_acesso = usuario.fk_acesso 
               WHERE usuario = '$usuario'";
   
      $resultado = mysqli_query($conn, $sql);
      $linha = mysqli_fetch_assoc($resultado);
      $id_usuario = $linha['id_usuario'];

      $return_registro = criarTopico($assunto, $data, $conteudo, $titulo, $id_usuario);

      if ($return_registro)
         echo 'success';
      
      else 
         echo 'error';
   }
   else{
      echo 'Nenhuma ação definida';
   }
   
}

?>