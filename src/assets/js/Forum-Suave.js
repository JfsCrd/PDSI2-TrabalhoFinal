$(window).on('load', function() {
   // Verifica se a página está sendo recarregada
   if (performance.navigation.type === 1) {
      // Oculta os resultados da busca
      $('#resultados-busca').css('display', 'none');

      // Exibe a animação de carregamento
      $.blockUI({
         message: '<div class="resultados-busca resultados-busca-popup">Atualizando tópicos...</div>',
         fadeIn: 0,
         fadeOut: 400,
         overlayCSS: { backgroundColor: '#f2f2f2', opacity: 0.8}
      });

      // Remove a animação de carregamento após um determinado tempo (por exemplo, 2 segundos)
      setTimeout(function() {
         $.unblockUI();

         // Exibe os resultados da busca após a remoção da animação
         $('#resultados-busca').css('display', 'block');
      }, 400);
   }
});
