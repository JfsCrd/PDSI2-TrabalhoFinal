$(document).ready(function () {
  $('#btn-comentar').on('click', function (event) {
    event.preventDefault();
    verificarRespostaPHP();
  });

  $('#form-criar-comentario').on('submit', function (event) {
    event.preventDefault();
    enviarFormulario();
  });
});

// Verifica se o usuário está apto a comentar
function verificarRespostaPHP() {
  $.ajax({
    url: 'Controller/Controller-Forum.php',
    method: 'POST',
    success: function (response) {
      console.log('Resposta do Ajax:', response);
      if (response.trim() === 'success') {
        $('#modal-novo-comentario').modal('show');
      } else {
        $('#modal-falha').modal('show');
      }
    },
    error: function () {
      $('#modal-falha').modal('show');
    }
  });
}

function enviarFormulario() {
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
}
