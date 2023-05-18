$(document).ready(function() {

  // Função para enviar a requisição AJAX
  function enviarRequisicao(termo) {
    $.ajax({
      url: 'Controller/Controller-Busca-Topico.php',
      method: 'GET',
      data: { termo: termo },
      success: function(result) {
        // Atualiza a página com os resultados da busca
        $('#resultados-busca').html(result);

        // Atualiza a barra de endereço com o termo de busca
        history.pushState({ termo: termo }, '', '?busca=' + encodeURIComponent(termo));
      }
    });
  }

  // Obtém o termo de busca da barra de endereço (se existir)
  var urlParams = new URLSearchParams(window.location.search);
  var termo = urlParams.get('termo') || '';

  // Preenche o campo de busca com o termo obtido
  $('#termo-busca').val(termo);

  // Envia a requisição AJAX para o servidor ao carregar a página
  enviarRequisicao(termo);

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
