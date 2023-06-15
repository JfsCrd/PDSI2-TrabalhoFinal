<?php

session_start();

include("../Model/Model-Topico.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $usuario = $_SESSION['usuario'];

   // Infos do post
   $assunto = filter_input(INPUT_POST, "assunto", FILTER_SANITIZE_STRING);
   $titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING);
   $conteudo = filter_input(INPUT_POST, "conteudo", FILTER_SANITIZE_STRING);

   $data = date("Y-m-d");

   $acao = $_POST['acao'];

   
   if ($acao === 'criar') {

      // Pega o ID do usuário para vincular ao tópico
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

         if ($linha) {
            $id_usuario = $linha['id_usuario'];

            // Obtém a URL do tópico recém-criado
            $url_topico = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $titulo));
            $url_topico = $id_usuario . '-' . $url_topico;

            // Chamando a função de registro
            $return_registro = criarTopico($assunto, $data, $conteudo, $titulo, $id_usuario, $url_topico);

            if ($return_registro['success'] === true) {
               // Obtém o ID do tópico recém-criado
               $url_topico = $return_registro['url'];

               // Retorna uma resposta JSON com o status e a URL do tópico
               $response = array(
                  'status' => 'success',
                  'topicUrl' => $url_topico
               );
               echo json_encode($response);
            } 
            else
               echo 'error';
         } 
         else
            echo 'error';
      } 
      else
         echo 'error';
   } else
      echo 'Nenhuma ação definida';
}

?>