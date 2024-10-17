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

      <button onclick="toggleDropdown()" class="btn-filtro dropbtn">Tipos <i data-lucide="chevron-down"></i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#">Carnes Vermelhas</a>
          <a href="#">Carnes Brancas</a>
          <a href="#">Carnes de Caça</a>
          <a href="#">Carnes Processadas</a>
          <a href="#">Carnes Exóticas</a>
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