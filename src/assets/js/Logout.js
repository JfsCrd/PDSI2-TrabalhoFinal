document.getElementById('botao-logout').addEventListener('click', function (event) {
    event.preventDefault(); // evita o comportamento padrão do botão
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'Controller/Controller-Secao.php', true); // define o método e o URL do arquivo PHP
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Sessão encerrada'); // exibe a mensagem no console
            window.location.replace('/login.html'); // redireciona para a página de login
        }
    };
    xhr.send(); // envia a requisição AJAX
});