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
<div style="width: 100%; padding: 0 10%; display: flex; flex-direction: column; align-items: center; justify-content: space-between; height: 5rem;">
  <nav class="container">
    <div class="row"><!--TODO: INCLUIR NA CLASSE DROPDOWN-->
      <header class="col-sm dropdown" style="align-items: center; justify-content:center;">

      <button onclick="toggleDropdown()" class="btn-filtro dropbtn">Origem Botânica <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#">Cítricas</a>
          <a href="#">Tropicais</a>
          <a href="#">Pseudofrutas</a>
        </div>

        <button onclick="toggleDropdown1()" class="btn-filtro dropbtn">Sabor <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown1" class="dropdown-content">
          <a href="#">Doces</a>
          <a href="#">Ácidas</a>
          <a href="#">Neutras</a>
        </div>

        <button onclick="toggleDropdown2()" class="btn-filtro dropbtn">Textura <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown2" class="dropdown-content">
          <a href="#">Carnosas</a>
          <a href="#">Fibrosas</a>
          <a href="#">Sementes</a>
        </div>

        <button onclick="toggleDropdown3()" class="btn-filtro dropbtn">Nutrientes <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown3" class="dropdown-content">
          <a href="#">Ricas em vitaminas C</a>
          <a href="#">Ricas em Potássio</a>
          <a href="#">Ricas em Fibras</a>
        </div>

        <button onclick="toggleDropdown4()" class="btn-filtro dropbtn">Caloria <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown4" class="dropdown-content">
          <a href="#">Alta Caloria</a>
          <a href="#">Baixa Caloria</a>
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
</div>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>

</body>
</html>