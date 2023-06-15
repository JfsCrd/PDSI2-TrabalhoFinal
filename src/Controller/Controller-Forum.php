<?php

session_start();

include("../Model/Model-Topico.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $usuario = $_SESSION['usuario'];

   include("../Model/Model-DataBase.php");

   $sql = "SELECT usuario.*
        FROM usuario
        JOIN contato ON contato.id_contato = usuario.fk_contato 
        JOIN experiencia_concluida ON experiencia_concluida.id_experiencia_concluida = usuario.fk_experiencia_concluida
        JOIN experiencia_profissional ON experiencia_profissional.id_experiencia_profissional = usuario.fk_experiencia_profissional
        WHERE usuario.id_usuario = '$usuario'
        AND contato.pais IS NOT NULL
        AND contato.estado IS NOT NULL
        AND contato.cidade IS NOT NULL
        AND contato.bairro IS NOT NULL
        AND contato.rua IS NOT NULL
        AND contato.numero IS NOT NULL
        AND contato.cep IS NOT NULL
        AND experiencia_concluida.conclusao IS NOT NULL
        AND experiencia_concluida.formacao IS NOT NULL
        AND experiencia_concluida.instituicao IS NOT NULL
        AND experiencia_concluida.titulo IS NOT NULL
        AND experiencia_profissional.area IS NOT NULL
        AND experiencia_profissional.cargo IS NOT NULL
        AND experiencia_profissional.empresa IS NOT NULL";

   $verificacao = mysqli_query($conn, $sql);
   $numLinhas = mysqli_num_rows($verificacao);

   if ($numLinhas > 0) {
      echo 'success';
   } else {
      echo 'falha';
   }



}
?>