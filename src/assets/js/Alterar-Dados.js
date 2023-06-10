$(document).ready(function () {
  $('#formUpdate').submit(function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Obtém os dados do formulário
    var formData = $(this).serialize();

    // Envia os dados do formulário via AJAX
    $.ajax({
      type: 'POST',
      url: 'Controller/Controller-Usuario.php',
      data: formData,
      success: function (response) {
        if (response === 'success') {
          // Exibir o modal de sucesso
          $('#modal-sucesso').modal('show');
          $('#modal-sucesso').on('hidden.bs.modal', function () {
            // Redirecionar para a página de editar dados novamente
            window.location.href = 'Editar-Perfil.php';
          });
        }
        else {
          // Exibir o modal de falha
          console.log(response)
          $('#modal-falha').modal('show');
          $('#modal-falha').on('hidden.bs.modal', function () {
            // Redirecionar para a página de editar dados novamente
            window.location.href = 'Editar-Perfil.php';
          });
        }
      }
    });
  });
});

function campoAlterado(campo) {
  campo.classList.add("campo-alterado");
  campo.style.backgroundColor = "#d4eeeb";
}
