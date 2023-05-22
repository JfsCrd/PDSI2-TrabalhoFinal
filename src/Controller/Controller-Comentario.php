<?php

session_start();

include("../Model/Model-Comentario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $usuario = $_SESSION['usuario'];

   // Infos do post
   $comentario = filter_input(INPUT_POST, "conteudo", FILTER_SANITIZE_STRING);
   $id_topico = $_POST['id_post'];

   $data = date("Y-m-d");

   $acao = $_POST['acao'];

   if ($acao === 'comentar') {

      // Pega o ID do usuário para vincular ao comentário
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
            
            // Chamando a função de registro de comentário
            $return_registro = criarComentario($comentario, $id_usuario, $data, $id_topico);

            if ($return_registro === true) 
               echo 'success';
            else 
               echo 'error';
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

else {
   $url = $_GET['url'];

   $sql = "SELECT usuario.nome, usuario.sobrenome, usuario.foto, comentario.data, comentario.comentario, 
         comentario.fk_topico, comentario.fk_usuario, comentario.id_comentario, topico.url
         FROM comentario
         JOIN usuario ON usuario.id_usuario = comentario.fk_usuario
         JOIN topico ON topico.id_topico = comentario.fk_topico
         WHERE topico.url = '$url'
         ORDER BY comentario.data DESC";

   $result = $conn->query($sql);


   // Exibe os resultados da busca
   $html = ''; // inicializa a variável com uma string vazia

   if ($result->num_rows > 0) {
      $html .= '<small class="text-muted" style="margin-left: 10px;">' . mysqli_num_rows($result) . ' comentário(s) nesta publicação.</small><br/><br/>';
      while ($row = $result->fetch_assoc()) {
         $html .= '
         <div class="container-fluid" style="border-bottom: 1px solid #4b4c4d2c; padding-right:40px; padding-bottom: 20px">
            <div class="row">
               <div class="col-md-2">
                  <img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" class="card-img" alt="Foto do usuário" style="border-radius:0px">
                  <h6 style="margin-top: 10px;">
                  ' . $row['nome'] . ' ' . $row['sobrenome'] . '
                  </h6>
               </div>
               <div class="col-md-10">
                  <p style="font-size: 12px">Publicado em: '.$row['data']. '</p>
                  <div class="post-content" style="margin-right: 40px; overflow-x: auto;">
                  '. $row['comentario'].'
               </div>
               </div>
            </div>
         </div>
         <br/>
     ';
      }
   } 
   
   else
      $html = 'Esta publicação ainda não tem comentário. Que tal escrever um?';

   // Fecha a conexão com o banco de dados
   $conn->close();

   // Retorna os resultados da busca como HTML
   echo $html;

   }

?>
