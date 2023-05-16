$(document).ready(function() {

  // Função para enviar a requisição AJAX
  function enviarRequisicao(termo) {
    $.ajax({
      url: '/Controller/Controller-Busca-Topico.php',
      method: 'POST',
      data: { termo: termo },
      success: function(result) {
        // Atualiza a página com os resultados da busca
        $('#resultados-busca').html(result);
      }
    });
  }

  // Obtém o termo de busca digitado pelo usuário
  var termo = $('#termo-busca').val();

  // Envia a requisição AJAX para o servidor
  enviarRequisicao(termo);

  // Atualiza a página com os resultados da busca ao recarregar
  $(window).on('beforeunload', function() {
    enviarRequisicao(termo);
  });

  // Atualiza a página com os resultados da busca ao submeter o formulário
  $('#form-busca').submit(function(event) {
    // Previne que a página seja recarregada após a submissão do formulário
    event.preventDefault();

    // Obtém o termo de busca digitado pelo usuário
    termo = $('#termo-busca').val();

    // Envia a requisição AJAX para o servidor
    enviarRequisicao(termo);
  });
});
