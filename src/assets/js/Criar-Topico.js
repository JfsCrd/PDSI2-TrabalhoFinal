$(document).ready(function() {
  $('#form-criar-topico').on('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var formData = {
      assunto: $('#assunto').val(),
      titulo: $('#titulo').val(),
      conteudo: $('#conteudo').val(),
      acao: 'criar'
    };

    $.ajax({
      type: 'POST',
      url: 'Controller/Controller-Topico.php',
      data: formData,
      dataType: 'json',
      success: function(response) {
        console.log('Resposta do Ajax:', response);
        if (response.hasOwnProperty('status') && response.status.trim() === 'success') {
          var topicUrl = response.topicUrl;
          // Oculta o modal para criar um novo tópico
          $('#modal-novo-topico').modal('hide');
          // Exibir o modal de sucesso
          $('#modal-sucesso').modal('show');
          // Quando o modal for fechado
          $('#modal-sucesso').on('hidden.bs.modal', function() {
            // Redirecionar para a página do tópico recém-criado
            window.location.href = 'Topico.php?url=' + topicUrl;
          });
        } else {
          $('#modal-novo-topico').modal('hide');
          $('#modal-falha').modal('show');
          $('#modal-falha').on('hidden.bs.modal', function() {
            location.reload();
          });
        }
      }
    });
    
  });
});
