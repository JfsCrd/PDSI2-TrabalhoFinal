$(document).ready(function () {
  $('#form-criar-comentario').on('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var formData = {
      conteudo: $('#conteudo').val(),
      id_post: $('#id_post').val(),
      acao: 'comentar'
    };

    $.ajax({
      type: 'POST',
      url: 'Controller/Controller-Comentario.php',
      data: formData,
      success: function (response) {
        console.log('Resposta do Ajax:', response);
        if (response.trim() === 'success') {
          // Oculta o modal para criar um novo comentário
          $('#modal-novo-comentario').modal('hide');
          // Exibir o modal de sucesso
          $('#modal-sucesso').modal('show');
          $('#modal-sucesso').on('hidden.bs.modal', function () {
            location.reload();
          });
        } else {
          $('#modal-novo-comentario').modal('hide');
          $('#modal-falha').modal('show');
          $('#modal-falha').on('hidden.bs.modal', function () {
            location.reload();
          });
        }
      }
    });
  });
});
