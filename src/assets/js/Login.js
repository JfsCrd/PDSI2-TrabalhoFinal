$(document).ready(function () {
    $('#formLogin').on('submit', function (event) {
      event.preventDefault(); // Impede o envio padrão do formulário
  
      var formData = {
        password: $('#password').val(),
        username: $('#username').val(),
        acao: $('#acao').val()
      };
  
      $.ajax({
        type: 'POST',
        url: 'Controller/Controller-Usuario.php',
        data: formData,
        success: function (response) {
          console.log('Resposta do Ajax:', response);
          if (response.trim() === 'sucesso') {
            // Oculta o modal para criar um novo comentário
            window.location.replace('../Alumni.php');
          } else {
            console.log(response)
          }
        }
      });
    });
  });
  
