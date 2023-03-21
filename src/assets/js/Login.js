// adiciona um ouvinte de evento para enviar a requisição AJAX quando o formulário for enviado
document.getElementById('formLogin').addEventListener('submit', function (event) {
    event.preventDefault(); // evita o envio do formulário padrão
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var acao = document.getElementById('acao').value;

    // cria um objeto XMLHttpRequest para enviar a requisição AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'Controller/Controller-Usuario.php', true); // define o método e o URL da requisição
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // define o cabeçalho da requisição
    xhr.onreadystatechange = function () {

        if (xhr.readyState === 4 && xhr.status === 200) {
            // verifica a resposta do servidor e exibe uma mensagem de alerta se o login falhar
            if (xhr.responseText === 'sucesso') {
                window.location.replace('Alumni.php');
            } 
            else {
                // redireciona para a página desejada se o login for bem sucedido
                alert('Login mal sucedido. Verifique suas credenciais e tente novamente.');                
            }
        }
    };
    // envia a requisição AJAX com os dados de login
    xhr.send('username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password) + '&acao=' + encodeURIComponent(acao));

});
