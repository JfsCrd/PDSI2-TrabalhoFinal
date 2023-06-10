function buscarVagas(termoBusca, termoLoc) {
   var chaveAPI = '7a25fd1d55b369afe15bc2b12e1f2d8f';

   var url = 'https://api.adzuna.com/v1/api/jobs/br/search/1?app_id=cd2ca8c5&app_key=' + chaveAPI + '&results_per_page=100' + '&what=' + termoBusca+'&sort_by=date&where=' + termoLoc;

   fetch(url)
      .then(function (response) {
         return response.json();
      })
      .then(function(data) {
         var resultadosBusca = document.getElementById("resultados-busca");
         resultadosBusca.innerHTML = ""; // Limpa o conteúdo existente
      
         var vagas = data.results; // Obtém a lista de vagas da resposta da API
      
         // Verifica se há vagas disponíveis
         if (vagas.length > 0) {
           vagas.forEach(function(vaga, index) {
             var card = document.createElement("div");
             card.classList.add("card", "card-xs", "mb-1");
             card.style.borderRadius = "0px";
      
             var row = document.createElement("div");
             row.classList.add("row", "no-gutters");
      
             var col = document.createElement("div");
             col.classList.add("col-md-12");
      
             var cardBody = document.createElement("div");
             cardBody.classList.add("card-body");
      
             // Cria o link com o título da vaga
             var linkVaga = document.createElement("a");
             linkVaga.href = vaga.redirect_url;
             linkVaga.style.textDecoration = "none";
      
             var titulo = document.createElement("h5");
             titulo.classList.add("card-title");
             titulo.textContent = vaga.title;
      
             linkVaga.appendChild(titulo);
             linkVaga.target = "_blank";
             cardBody.appendChild(linkVaga);
      
             var empresa = document.createElement("p");
             empresa.classList.add("card-text");
             
             // Cria o elemento para exibir a localização
             var localizacao = document.createElement("span");
             localizacao.textContent = vaga.location.display_name + " - ";
             localizacao.classList.add("localizacao");
             empresa.appendChild(localizacao);
             
             empresa.textContent += vaga.company.display_name;
             cardBody.appendChild(empresa);
             
             // Cria o elemento para exbir a descrição da vaga
             var descricao = document.createElement("div");
             descricao.classList.add("card-footer", "bg-transparent", "border-success");
             descricao.textContent = vaga.description;
             cardBody.appendChild(descricao);
      
             var footer = document.createElement("div");
             footer.classList.add("card-footer", "bg-transparent");
      
            // Cria o elemento de salário
            var salario = document.createElement("p");
            salario.textContent = "Salário: " + ("R$", vaga.salary || "Desconhecido");
            salario.classList.add("elemento-inline");
            footer.appendChild(salario);

            // Cria um objeto de data a partir da string da data de publicação
            var dataPublicacao = new Date(vaga.created);

            // Obtém os componentes da data (dia, mês, ano)
            var dia = dataPublicacao.getDate();
            var mes = dataPublicacao.getMonth() + 1;
            var ano = dataPublicacao.getFullYear();

            // Formata a data no formato DD/MM/YYYY
            var dataFormatada = dia + '/' + mes + '/' + ano;

            // Cria o elemento para exibir a data formatada
            var dataElemento = document.createElement("p");
            dataElemento.textContent = "Data de publicação: " + dataFormatada;
            dataElemento.classList.add("elemento-inline");
            footer.appendChild(dataElemento);

      
             // Cria o link para a vaga
             var linkIrParaVaga = document.createElement("a");
             linkIrParaVaga.classList.add("link");
             linkIrParaVaga.href = vaga.redirect_url;
             linkIrParaVaga.textContent = "Acessar vaga";
             linkIrParaVaga.target = "_blank"; // Abre o link em uma nova guia
             footer.appendChild(linkIrParaVaga);
      
             cardBody.appendChild(footer);
      
             col.appendChild(cardBody);
             row.appendChild(col);
             card.appendChild(row);
      
             resultadosBusca.appendChild(card); // Adiciona o card à seção de resultados
      
             // Adiciona uma quebra de linha após cada card, exceto o último
             if (index < vagas.length - 1) {
               var br = document.createElement("br");
               resultadosBusca.appendChild(br);
             }
           });
         } else {
           resultadosBusca.textContent = "Nenhum resultado encontrado."; // Caso não haja vagas disponíveis
         }
      })
      .catch(function (error) {
         console.log('Ocorreu um erro:', error);
      });
}

document.addEventListener("DOMContentLoaded", function () {
   document.getElementById("form-busca").addEventListener("submit", function (event) {
      event.preventDefault(); // Evita o envio padrão do formulário
      var termoBusca = document.getElementById("termo-busca").value;
      var termoLoc = document.getElementById("termo-loc").value;
      buscarVagas(termoBusca, termoLoc);
   });
});
