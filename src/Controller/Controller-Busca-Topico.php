<?php

include("../Model/Model-Usuario.php");

// Array associativo para imagens por assunto
$assunto_imagem_map = array(
   'Algoritmos e Estruturas de Dados' => '../assets/img/Topicos/CC.png',
   'Arquitetura de Computadores' => '../assets/img/topicos/CC.png',
   'Inteligência Artificial' => '../assets/img/topicos/CC.png',
   'Redes de Computadores' => '../assets/img/topicos/CC.png',
   'Segurança da Informação' => '../assets/img/topicos/CC.png',
   'sistemas">Sistemas Distribuídos' => '../assets/img/topicos/CC.png',
   'Teoria da Computação' => '../assets/img/topicos/CC.png',
   'Métodos Ágeis' => '../assets/img/topicos/.png',
   'Padrões de Projeto' => '../assets/img/topicos/.png',
   'Processos de Desenvolvimento de Software' => '../assets/img/topicos/.png',
   'Qualidade de Software' => '../assets/img/topicos/.png',
   'Teste de Software' => '../assets/img/topicos/.png',
   'Administração de Banco de Dados' => '../assets/img/topicos/.png',
   'Modelagem de Dados' => '../assets/img/topicos/.png',
   'SQL e Bancos de Dados Relacionais' => '../assets/img/topicos/.png',
   'Bancos de Dados NoSQL' => '../assets/img/topicos/.png',
   'Memórias' => '../assets/img/topicos/.png',
   'Outros' => '../assets/img/topicos/.png'
);

// Obtém o termo de busca enviado pelo usuário
$termo = $_POST['termo'];

// Escapa o termo para evitar SQL injection
$termo = $conn->real_escape_string($termo);

// Realiza a busca no banco de dados
$sql = "SELECT usuario.nome, usuario.sobrenome, topico.titulo, topico.conteudo, topico.assunto, topico.data FROM forum
         JOIN topico ON topico.id_topico = forum.fk_topicos
         JOIN usuario ON usuario.id_usuario = forum.fk_usuario
         WHERE titulo LIKE '%$termo%' OR  topico.assunto LIKE '%$termo%' OR topico.conteudo LIKE '%$termo%'
         ORDER BY titulo ASC";

$result = $conn->query($sql);

// Exibe os resultados da busca
$html = ''; // inicializa a variável com uma string vazia

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      $assunto = $row['assunto'];
      $conteudo = $row['conteudo'];
      $imagem = isset($assunto_imagem_map[$assunto]) ? $assunto_imagem_map[$assunto] : '../assets/img/topicos/.png';
      if (strlen($conteudo) > 400) {
         $conteudo = substr($conteudo, 0, 400);
         $last_space = strrpos($conteudo, ' ');
         $conteudo = substr($conteudo, 0, $last_space) . '... Ler mais';
      }
      $html .= '
      <small class="text-muted">Resultados encontrados: ' . mysqli_num_rows($result) .'</small>
      <br/>
      <br/>
      <div class="card card-xs mb-1" style="border-radius:0px;">

      <div class="row no-gutters">
      <div class="col-md-2">
          <img src="'. $imagem . '" class="card-img" alt="" style="border-radius:0px">
      </div>
      <div class="col-md-10">
            <div class="card-body">
                  <h5 class="card-title">' . $row['titulo'] .'</h5>
                  <small class="text-muted">Por: ' . $row['nome'] .' '. $row['sobrenome'].', em ' 
                  . $row['data'] .' </small>
                  <div class="card-footer bg-transparent" style="text-align: justify; margin-left:-20px"; >
                     <p style="color: #696969;">'. $conteudo .'</p>
                  </div>
            </div>
      </div>
      </br>';
   }
} 

else {
   $html = 'Nenhum tópico encontrado.';
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os resultados da busca como HTML
echo $html;

?>
