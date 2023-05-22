$(document).ready(function() {
   // Função para carregar os comentários através de AJAX
   function carregarComentarios() {
      // Recupera o valor do parâmetro "url" da URL
      var url = getUrlParameter('url');

      // Faz a requisição AJAX
      $.ajax({
         type: 'GET',
         url: 'Controller/Controller-Comentario.php',
         data: {
            url: url
         },
         dataType: 'html',
         success: function(response) {
            $('#comentarios').html(response);
         },
         error: function() {
            $('#comentarios').html('Ocorreu um erro ao carregar os comentários.');
         }
      });
   }

   // Função para obter o valor de um parâmetro da URL
   function getUrlParameter(name) {
      var urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(name);
   }

   // Chama a função para carregar os comentários quando a página é carregada
   carregarComentarios();
});
