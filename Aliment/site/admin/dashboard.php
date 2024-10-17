<?php
  session_start();

  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login-adm.php");
    exit();
  }

  $session_duration = 6 * 60 * 60; // 6 horas em segundos
  $current_time = time();

  if (($current_time - $_SESSION["start_time"]) > $session_duration) {
    session_unset();
    session_destroy();
    setcookie("user_session", "", time() - 3600, "/"); // Expirar o cookie
    header("Location: login-adm.php");
    exit();
  }

  $email = $_SESSION["email"];

  $servername = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $dbname = "alimenth";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
  }

  $sql = "SELECT nome_completo FROM administradores WHERE email = '$email'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $nome_completo = $row['nome_completo'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="stylesheet" href="/css/admin.css">
  <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

  <title>Dashboard - Alimenth</title>
</head>

<body style="background-color: #EDE3C8;">
  <?php include '../includes/cabecalho.php';?>

  <main class="container" style="display: flex;">
    <section class="col-sm" style="text-align: center; align-items:center;">

      <?php echo "<h2 style='margin: 20px 0; text-transform:uppercase; font-family:Times New Roman; text-align:center;'> Bem-vindo ao Dashboard, $nome_completo!</h2>"; ?>

      <article style="display: flex;">
        <div>
          <h3 style="margin: 10px 0; text-transform:uppercase; font-family:Raillinc; text-align:center;">Alimentos</h3>
          <a href="actions_ali/add_ali.php"> <!--TODO - TRABALHANDO NESSE!!! - Adicionando o link e arrumando a página add_ali.php -->
            <button class="btn-add">
              <i data-lucide="plus"></i> <br>
              Adicionar Alimento
            </button>
          </a>

          <a href="actions_ali/alterar_ali.php">
            <button class="btn-add">
              <i data-lucide="square-pen"></i> <br>
              Alterar Alimento
            </button>
          </a>

          <a href="">
            <button class="btn-add">
              <i data-lucide="x"></i> <br>
              Excluir Alimento
            </button>
          </a>

          <a href="">
            <button class="btn-add">
              <i data-lucide="notepad-text"></i> <br>
              Listar Alimentos
            </button>
          </a>
        </div>

        <article style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
          <div class="image-container">
            <figure class="figure0">
              <img src="/img/bg-morango.jpeg" alt="Morangos" class="square">
            </figure>
          </div>

          <div class="image-container">
            <figure class="figure0">
              <img src="/img/bg-pessego.jpeg" alt="Pêssegos" class="square">
            </figure>
          </div>

          <div class="image-container">
            <figure class="figure0">
              <img src="/img/bg-laranja.jpeg" alt="Laranjas" class="square">
            </figure>
          </div>

          <div class="image-container">
            <figure class="figure0">
              <img src="/img/bg-banana.jpeg" alt="Bananas" class="square">
            </figure>
          </div>
        </article>

        <div>
          <h3 style="margin: 10px 0; text-transform:uppercase; font-family:Raillinc; text-align:center;">Administradores</h3>

          <a href="actions_adm/add_adm.php">
            <button class="btn-add">
              <i data-lucide="user-round-plus"></i> <br>
              Adicionar Administrador
            </button>
          </a>

          <a href="actions_adm/select_adm.php">
            <button class="btn-add">
              <i data-lucide="user-round"></i> <br>
              Alterar Administrador
            </button>
          </a>

          <a href="actions_adm/excluir_adm.php">
            <button class="btn-add">
              <i data-lucide="user-round-x"></i> <br>
              Remover Administrador
            </button>
          </a>

          <a href="actions_adm/list_adm.php">
            <button class="btn-add">
              <i data-lucide="users-round"></i> <br>
              Listar Administradores
            </button>
          </a>
          
        </div>
      </article>

      <a href="logout.php">
        <button class="btn-add">
          <i data-lucide="log-out"></i> <br>
          Sair
        </button>
      </a>
    </section>
  </main>

  <?php include '../includes/footer.php';?>

  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>
</body>
</html>