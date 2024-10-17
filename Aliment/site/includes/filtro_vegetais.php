<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="/css/categorias.css">
  <title>Document</title>
</head>

<body>
  <nav class="container"> 
    <div class="row">
      <header class="col-sm dropdown" style="align-items: center; justify-content:center;">

      <button onclick="toggleDropdown()" class="btn-filtro dropbtn">Origem Botânica <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#">Temperado</a>
          <a href="#">Tropical</a>
        </div>

        <button onclick="toggleDropdown2()" class="btn-filtro dropbtn">Textura <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown2" class="dropdown-content">
          <a href="#">Folhosos</a>
          <a href="#">Raízes e Tubérculos</a>
          <a href="#">Flores</a>
          <a href="#">Legumes</a>
        </div>

        <button onclick="toggleDropdown3()" class="btn-filtro dropbtn">Tipos de Vegetais <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown3" class="dropdown-content">
          <a href="#">Folhosos</a>
          <a href="#">Raízes</a>
          <a href="#">Bulbos</a>
          <a href="#">Tubérculos</a>
          <a href="#">Flores</a>
          <a href="#">Frutos</a>
          <a href="#">Legumes</a>
          <a href="#">Caules</a>
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

        //  TIPOS DE VEGETAIS
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