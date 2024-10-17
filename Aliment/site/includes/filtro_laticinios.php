<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="stylesheet" href="/css/categorias.css">

  <title>Document</title>
</head>

<body>
  <nav class="container">
    <div class="row"><!--TODO: INCLUIR NA CLASSE DROPDOWN-->
      <header class="col-sm dropdown" style="align-items: center; justify-content:center;">

      <button onclick="toggleDropdown()" class="btn-filtro dropbtn">Processo de Produção <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#">Frescos</a>
          <a href="#">Fermentados</a>
          <a href="#">Curados</a>
          <a href="#">Processados</a>
        </div>

        <button onclick="toggleDropdown1()" class="btn-filtro dropbtn">Teor de Gordura <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown1" class="dropdown-content">
          <a href="#">Integral</a>
          <a href="#">Desnatado</a>
          <a href="#">Sem Gurdura</a>
        </div>

        <button onclick="toggleDropdown2()" class="btn-filtro dropbtn">Textura <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown2" class="dropdown-content">
          <a href="#">Líquidos</a>
          <a href="#">Cremosos</a>
          <a href="#">Sólidos</a>
          <a href="#">Fibrosos</a>
        </div>

        <button onclick="toggleDropdown3()" class="btn-filtro dropbtn">Nutrientes <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown3" class="dropdown-content">
          <a href="#">Ricos em Proteínas</a>
          <a href="#">Ricos em Cálcio</a>
          <a href="#">Ricos em Gordura</a>
          <a href="#">Reduzidos em Gordura</a>
        </div>

        <button onclick="toggleDropdown4()" class="btn-filtro dropbtn">Sabor <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown4" class="dropdown-content">
          <a href="#">Neutro</a>
          <a href="#">Ácido</a>
          <a href="#">Salgado</a>
          <a href="#">Doce</a>
        </div>
      </div>

      <script>
        //ORIGEM BOTÂNICA
        // Função para alternar a exibição do dropdown
        function toggleDropdown() {
          document.getElementById("myDropdown").classList.toggle("show");
        }

        // Fecha o dropdown se o usuário clicar fora dele
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }

        //SABOR
        // Função para alternar a exibição do dropdown
        function toggleDropdown1() {
          document.getElementById("myDropdown1").classList.toggle("show");
        }

        // Fecha o dropdown se o usuário clicar fora dele
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }

        //TEXTURA
        function toggleDropdown2() {
          document.getElementById("myDropdown2").classList.toggle("show");
        }

        // Fecha o dropdown se o usuário clicar fora dele
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }

        //NUTRIENTES
        function toggleDropdown3() {
          document.getElementById("myDropdown3").classList.toggle("show");
        }

        // Fecha o dropdown se o usuário clicar fora dele
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }

        //CALORIA
        function toggleDropdown4() {
          document.getElementById("myDropdown4").classList.toggle("show");
        }

        // Fecha o dropdown se o usuário clicar fora dele
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }}
          }
        </script>
      </header>
    </div>
  </nav>

  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>

</body>
</html>