$(document).ready(function () {
  $('#btn-novo-topico').on('click', function (event) {
    event.preventDefault();
    verificarRespostaPHP();
  });

  $('#form-criar-topico').on('submit', function (event) {
    event.preventDefault();
    enviarFormulario();
  });
});

function verificarRespostaPHP() {
  $.ajax({
    url: 'Controller/Controller-Forum.php',
    method: 'POST',
    success: function (response) {
      console.log('Resposta do Ajax:', response);
      if (response.trim() === 'success') {
        $('#modal-novo-topico').modal('show');
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
    success: function (response) {
      console.log('Resposta do Ajax:', response);
      if (response.hasOwnProperty('status') && response.status.trim() === 'success') {
        var topicUrl = response.topicUrl;
        $('#modal-novo-topico').modal('hide');
        $('#modal-sucesso').modal('show');
        $('#modal-sucesso').on('hidden.bs.modal', function () {
          window.location.href = 'Topico.php?url=' + topicUrl;
        });
      } else {
        $('#modal-novo-topico').modal('hide');
        $('#modal-falha').modal('show');
        $('#modal-falha').on('hidden.bs.modal', function () {
          location.reload();
        });
      }
    }
  });
}
