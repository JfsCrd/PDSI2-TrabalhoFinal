$(document).ready(function () {

  // Função para exibir o termo buscando na URL
  function exibirTermoBuscando() {
    $('#resultados-busca').html('Buscando...');
  }

  // Função para enviar a requisição AJAX
  function enviarRequisicao(termo, filtro) {
    // Exibe o termo buscando na URL
    exibirTermoBuscando();

    $.ajax({
      url: 'Controller/Controller-Busca.php',
      method: 'GET',
      data: { termo: termo, filtro: filtro},
      success: function (result) {
        // Remove a mensagem de busca antes de atualizar a página com os resultados
        $('#resultados-busca').html('');

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
  var filtro = urlParams.get('filtro') || '';

  // Preenche o campo de busca com o termo obtido
  $('#termo-busca').val(termo);
  $('#termo-filtro').val(filtro);

  // Envia a requisição AJAX para o servidor ao carregar a página
  enviarRequisicao(termo, filtro);

  // Atualiza a página com os resultados da busca ao submeter o formulário
  $('#form-busca').submit(function (event) {
    // Previne que a página seja recarregada após a submissão do formulário
    event.preventDefault();

    // Obtém o termo de busca digitado pelo usuário
    termo = $('#termo-busca').val();
    filtro = $('#termo-filtro').val();

    // Envia a requisição AJAX para o servidor
    enviarRequisicao(termo, filtro);
  });
});

function habilitarFiltro() {
  var termoBusca = document.getElementById("termo-busca");
  var termoFiltro = document.getElementById("termo-filtro");

  if (termoBusca.value.length > 0) {
      termoFiltro.disabled = false;
  } else {
      termoFiltro.disabled = true;
  }
}
