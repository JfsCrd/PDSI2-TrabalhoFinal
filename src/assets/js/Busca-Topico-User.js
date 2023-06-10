// Função para enviar a requisição AJAX
function meusTopicos(usuario) {
   $.ajax({
      url: 'Controller/Controller-Busca-Topico.php',
      method: 'GET',
      data: { usuario: usuario },
      success: function (result) {
         // Atualiza a página com os resultados da busca
         $('#resultados-busca').html(result);

         // Muda o placeholder da caixa de pesquisa e desativa o vampo de busca
         $('#termo-busca').attr('placeholder', 'Atualmente exibindo seus tópicos! Clique no botão ao lado para voltar a exibir todos os tópicos.');
         $('#termo-busca').attr('disabled', true);

         // Remove o ícone do botão
         $('#btn-busca i').removeClass('fas fa-search');

         // Adiciona o novo ícone ao botão
         $('#btn-busca i').addClass('fas fa-undo');

         // Desativa o botão de "Meu tópicos"
         $('#btn-meus').attr('disabled', true);
      }
   });
}

function trocarBotao() {

   // Muda o placeholder da caixa de pesquisa e ativa o campo de busca
   $('#termo-busca').attr('placeholder', 'Busque tópicos por título, conteúdo ou assunto');
   $('#termo-busca').attr('disabled', false);

   // Remove o ícone do botão
   $('#btn-busca i').removeClass('fas fa-undo');

   // Adiciona o novo ícone ao botão
   $('#btn-busca i').addClass('fas fa-search');

   // Ativa o botão "Meus Tópicos"
   $('#btn-meus').attr('disabled', false);

}