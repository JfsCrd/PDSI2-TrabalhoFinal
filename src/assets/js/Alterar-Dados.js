$(document).ready(function () {
  $('#formUpdate').submit(function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Cria um novo objeto FormData
    var formData = new FormData(this);
    formData.append('foto', $('#foto')[0].files[0]);

    // Envia os dados do formulário via AJAX
    $.ajax({
      type: 'POST',
      url: 'Controller/Controller-Usuario.php',
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Exibir o modal de sucesso
        $('#modal-sucesso').modal('show');
        $('#modal-sucesso').on('hidden.bs.modal', function () {
          // Redirecionar para a página de editar dados novamente
          window.location.href = 'Editar-Perfil.php';
        });
      },
      error: function () {
        // Exibir o modal de falha
        console.log(response)
        $('#modal-falha').modal('show');
        $('#modal-falha').on('hidden.bs.modal', function () {
          // Redirecionar para a página de editar dados novamente
          window.location.href = 'Editar-Perfil.php';
        });
      }
    });
  });
});

function campoAlterado(campo) {
  campo.classList.add("campo-alterado");
  campo.style.backgroundColor = "#d4eeeb";
}
