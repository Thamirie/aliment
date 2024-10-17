<?php
  function verificarAcesso() {
    session_start();
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
      header("location: login-adm.php");
      exit;
    }

    if ($_SESSION["superioridade"] == "Baixo") {
      include 'pagina-erro.php';
      exit;
    }
  }

  verificarAcesso();

  $servername = "localhost"; 
  $username = "root";
  $password = ""; 
  $dbname = "alimenth";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
  }

  $sql = "SELECT id, nome_completo FROM administradores";
  $result = $conn->query($sql);

  $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="stylesheet" href="/css/admin.css">
  <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

  <title>Selecionar Administrador</title>

  <style>
    .admin-option {
      font-family: 'Times New Roman', Times, serif;
      border-radius: 3px;
      background-color: #ffd59f;
      color: black;
      padding: 10px;
      margin-bottom: 15px;
      width: 90%;
      border: none;
      height: auto;
      text-align: center;
      text-transform: uppercase;
      justify-content: center;
    }

    .admin-option:hover {
      outline: none;
      background-color: #EDE3C8;
      border: 0.5px solid #6c6c6c;
      transition: all 0.2s linear;
    }
  </style>

  <script>
    function carregarFormulario(id) {
      window.location.href = "edit_adm.php?id=" + id;
    }
  </script>
</head>

<body style="background-color: #EDE3C8;">
  <?php include '../../includes/cabecalho.php';?>

  <main class="container" style="display: flex; justify-content:center; align-items:center; padding: 25px;flex-direction:column;">
    <a href="../dashboard.php"><button class="btn-back">Voltar</button></a>

    <div class="div">
      <h2>Selecione o Administrador</h2>

      <div style="display: flex; justify-content:center; align-items:center; flex-direction:column;">
        <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>

        <div class="admin-option" onclick="carregarFormulario(<?php echo $row['id']; ?>)">
          <?php echo $row['nome_completo']; ?>
        </div>

        <?php endwhile; ?>
        <?php else: ?>

        <p>Nenhum administrador encontrado.</p>

        <?php endif; ?>
      </div>
    </div>
  </main>
</body>
</html>