<?php

include("../Model/Model-Usuario.php");

// Obtém o termo de busca enviado pelo usuário
$termo = $_GET['termo'];

// Escapa o termo para evitar SQL injection
$termo = $conn->real_escape_string($termo);

// Realiza a busca no banco de dados
$sql = "SELECT * FROM usuario
        JOIN experiencia_concluida ON experiencia_concluida.id_experiencia_concluida = usuario.fk_experiencia_concluida
        JOIN acesso ON acesso.id_acesso = usuario.fk_acesso
        WHERE nome LIKE '%$termo%' OR sobrenome LIKE '%$termo%' OR formacao LIKE '%$termo%' OR conclusao LIKE '%$termo%' ORDER BY nome ASC";
$result = $conn->query($sql);

// Exibe os resultados da busca
$html = ''; // inicializa a variável com uma string vazia
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '
        <div class="card card-xs mb-1" style="border-radius:0px">
            <div class="row no-gutters">
                <div class="col-md-2">
                    <img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" class="card-img" alt="Foto do usuário" style="border-radius:0px">
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <a href="http://localhost/Perfil.php?usuario='.$row['usuario'] .'" style="text-decoration: none;">
                            <h5 class="card-title">' . $row['nome'] . ' '.$row['sobrenome'] .'</h5>
                        </a>
                        <p class="card-text">' . $row['formacao'] . ', ' . $row['instituicao'] . ', ' . $row['conclusao'] .'</p>
                        <div class="card-footer bg-transparent border-success">' . $row['resumo'] .'</div>
                    </div>
            </div>
        </div>
        </div>
        </br>';
    }
} else {
    $html = 'Nenhum resultado encontrado.';
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os resultados da busca como HTML
echo $html;

?>
