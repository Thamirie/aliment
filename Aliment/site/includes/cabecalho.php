<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="stylesheet" href="/css/geral.css">
  <title>Document</title>
</head>
<body>
  <header class="container cabecalho">
    <main class="row">
      <aside class="col-sm" style="align-items: center; justify-content:center; display:flex;">

        <a href="/index.php" style="display: flex; justify-content:center; align-items:center;">
          <button class="btn-logo">
            <img src="/img/aliment01.png" alt="Logo do Site Aliment">
          </button>
        </a>

      </aside>

      <nav class="col-sm nav-nvgc">
        <a href="/index.php">
          <button class="btn-nvgc">
            <i data-lucide="home"></i> <br>
            Início
          </button>
        </a>

        <a href="/site/info.php">
          <button class="btn-nvgc">
            <i data-lucide="info"></i><br>
            Info
          </button>
        </a>

        <a href="/site/quemsomos.php">
          <button class="btn-nvgc">
            <i data-lucide="smile"></i><br>
            Sobre
          </button>
        </a>

        <a href="/site/admin/login-adm.php">
          <button class="btn-nvgc">
            <i data-lucide="user"></i> <br>
            Login
          </button>
        </a>
      </nav>
    </main>
  </header>

  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>
</body>
</html>