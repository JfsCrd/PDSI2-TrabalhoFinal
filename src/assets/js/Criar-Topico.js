$(document).ready(function() {
  $('#form-criar-topico').on('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var formData = $(this).serialize(); // Serializa os dados do formulário

    $.ajax({
      type: 'POST',
      url: 'Controller/Controller-Topico.php',
      data: formData,
      success: function(response) {
        // Processar a resposta após o envio do formulário
        if (response === 'success') {
          $('#novoTopicoModal').modal('hide'); // Fecha o modal 'novoTopicoModal'
          $('#modal-sucesso').modal('show'); // Abre o modal 'modal-sucesso'
          $('#modal-sucesso').on('hidden.bs.modal', function() {
            location.reload(); // Recarrega a página após o modal 'modal-sucesso' ser fechado
          });
        }
      }
    });
  });
});
