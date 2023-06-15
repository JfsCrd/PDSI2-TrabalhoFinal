<?php

// Oculta warnings de menos de 3 termos na consulta
error_reporting(0);

include("../Model/Model-Usuario.php");

// Array associativo para imagens por assunto
$assunto_imagem_map = array(
   'Algoritmos e Estruturas de Dados' => '../assets/img/Topicos/CC.png',
   'Arquitetura de Computadores' => '../assets/img/topicos/CC.png',
   'Inteligência Artificial' => '../assets/img/topicos/CC.png',
   'Redes de Computadores' => '../assets/img/topicos/CC.png',
   'Segurança da Informação' => '../assets/img/topicos/CC.png',
   'Sistemas Distribuídos' => '../assets/img/topicos/CC.png',
   'Teoria da Computação' => '../assets/img/topicos/CC.png',
   'Métodos Ágeis' => '../assets/img/topicos/ESOF.png',
   'Padrões de Projeto' => '../assets/img/topicos/ESOF.png',
   'Processos de Desenvolvimento de Software' => '../assets/img/topicos/ESOF.png',
   'Qualidade de Software' => '../assets/img/topicos/ESOF.png',
   'Teste de Software' => '../assets/img/topicos/ESOF.png',
   'Administração de Banco de Dados' => '../assets/img/topicos/BD.png',
   'Modelagem de Dados' => '../assets/img/topicos/BD.png',
   'SQL e Bancos de Dados Relacionais' => '../assets/img/topicos/BD.png',
   'Bancos de Dados NoSQL' => '../assets/img/topicos/BD.png',
   'Memórias' => '../assets/img/topicos/Diversos.png',
   'Outros' => '../assets/img/topicos/Diversos.png'
);

// Obtém o termo de busca enviado pelo usuário
$termo = $_GET['termo'];

// Escapa o termo para evitar SQL injection
$termo = $conn->real_escape_string($termo);

// Recebe o usuário para busca de tópicos do usuário
$nome = $_GET['usuario'];

$sql = "SET lc_time_names = 'pt_BR'";
$conn->query($sql);

// Realiza a busca no banco de dados
// Se não for passado nenhum parâmetro
if ($termo === '' and $nome === '') {
   $sql = "SELECT usuario.nome, usuario.sobrenome, topico.*,
            DATE_FORMAT(topico.data, '%d de %b de %Y') AS data_formatada
            FROM topico
            JOIN usuario ON usuario.id_usuario = topico.fk_usuario
            ORDER BY topico.data DESC, topico.id_topico DESC";
   $result = $conn->query($sql);

} else if ($nome != null) {
   $sql = "SELECT usuario.nome, usuario.sobrenome, topico.*,
            DATE_FORMAT(topico.data, '%d de %b de %Y') AS data_formatada
            FROM topico
            JOIN usuario ON usuario.id_usuario = topico.fk_usuario
            WHERE usuario.nome = '$nome'
            ORDER BY topico.data DESC, topico.id_topico DESC";

   $result = $conn->query($sql);
}

// Caso haja parametros
else {

   $sql = "SET lc_time_names = 'pt_PT'";
   $conn->query($sql);

   $sql = "SELECT usuario.nome, usuario.sobrenome, topico.*, 
         DATE_FORMAT(topico.data, '%d de %b de %Y') AS data_formatada
         FROM topico
         JOIN usuario ON usuario.id_usuario = topico.fk_usuario
         WHERE titulo LIKE '%$termo%' OR  topico.assunto LIKE '%$termo%' OR topico.conteudo LIKE '%$termo%'
         ORDER BY topico.data DESC, topico.id_topico DESC";

   $result = $conn->query($sql);
}

// Exibe os resultados da busca
$html = ''; // inicializa a variável com uma string vazia

if ($result->num_rows > 0) {
   $html .= '<small class="text-muted">Resultados encontrados: ' . mysqli_num_rows($result) . '</small><br/>';
   while ($row = $result->fetch_assoc()) {
      $assunto = $row['assunto'];
      $conteudo = $row['conteudo'];
      $imagem = isset($assunto_imagem_map[$assunto]) ? $assunto_imagem_map[$assunto] : '../assets/img/topicos/.png';
      if (strlen($conteudo) > 400) {
         $conteudo = substr($conteudo, 0, 400);
         $last_space = strrpos($conteudo, ' ');
         $conteudo = substr($conteudo, 0, $last_space) . '... <a href="http://localhost/Topico.php?url=' . $row['url'] . '">Ler mais</a>';
      }
      $html .= '
         <br/>
         <div class="card card-xs mb-1" style="border-radius:0px;">
               <div class="row no-gutters">
                     <div class="col-md-2">
                        <img src="' . $imagem . '" class="card-img" alt="" style="border-radius:0px">
                     </div>
                     <div class="col-md-10">
                           <div class="card-body">
                              <a href="http://localhost/Topico.php?url=' . $row['url'] . '" style="text-decoration: none;">
                                 <h5 class="card-title">' . $row['titulo'] . ' <span style="font-size: 12px; color:#555555">  | ' . $row['assunto'] . '</span></h5>
                              </a>
                              <small class="text-muted">Por: ' . $row['nome'] . ' ' . $row['sobrenome'] . ', em ' . $row['data_formatada'] . ' </small>
                              <div class="card-footer bg-transparent" style="text-align: justify; margin-left:-20px"; >
                                    <p style="color: #696969;">' . $conteudo . '</p>
                              </div>
                           </div>
                     </div>
               </div>
         </div>
         <br/>';


   }
} else {
   $html = 'Nenhum tópico encontrado.';
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os resultados da busca como HTML
echo $html;

?>