$('#novoTopicoModal').on('show.bs.modal', function () {
  $('body').css('overflow-y', 'hidden');
})

$('#novoTopicoModal').on('hide.bs.modal', function () {
  $('body').css('overflow-y', 'auto');
})
