<?php

include("../Model/Model-Usuario.php");

// Obtém o termo de busca enviado pelo usuário
$termo = $_POST['termo'];

// Escapa o termo para evitar SQL injection
$termo = $conn->real_escape_string($termo);

// Realiza a busca no banco de dados
$sql = "SELECT * FROM usuario
        JOIN experiencia_concluida ON experiencia_concluida.id_experiencia_concluida = usuario.fk_experiencia_concluida
        WHERE nome LIKE '%$termo%' OR sobrenome LIKE '%$termo%' ORDER BY nome ASC";
$result = $conn->query($sql);

// Exibe os resultados da busca
$html = ''; // inicializa a variável com uma string vazia
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-2">
                    <img src="..." class="card-img" alt="...">
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['nome'] . ' '.$row['sobrenome'] .'</h5>
                        <p class="card-text">' . $row['formacao'] . ', ' . $row['instituicao'] . ', ' . $row['conclusao'] .'</p>
                    </div>
            </div>
        </div>
        </div>';
    }
} else {
    $html = 'Nenhum resultado encontrado.';
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os resultados da busca como HTML
echo $html;

?>
