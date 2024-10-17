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

  $categoria = '';

  if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $sql = "SELECT * FROM alimentos WHERE categoria = '$categoria'";
  } else {
    $sql = "SELECT * FROM alimentos";
  }

  $result = $conn->query($sql);

  $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="stylesheet" href="/css/dashboard.css">
  <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

  <title>Selecionar Alimento</title>

  <style>
    .food-option {
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

    .food-option:hover {
      outline: none;
      background-color: #EDE3C8;
      border: 0.5px solid #6c6c6c;
      transition: all 0.2s linear;
    }
  </style>

  <script>
    function carregarFormulario(id) {
      window.location.href = "edit_food.php?id=" + id;
    }
  </script>
</head>

<body style="background-color: #EDE3C8;">
  <?php include '../../includes/cabecalho.php';?>

  <main class="container" style="display: flex; justify-content:center; align-items:center; padding: 25px;flex-direction:column;">
    <a href="../dashboard.php"><button class="btn-back">Voltar</button></a>

    <div class="div">
      <h2>Filtrar por Categoria</h2>

      <form method="GET" action="" style="margin-bottom: 20px;">
        <select name="categoria" class="input_add" required>
          <option value="">Selecione uma categoria</option>
          <option value="Frutas" <?php echo $categoria == 'Frutas' ? 'selected' : ''; ?>>Frutas</option>
          <option value="Vegetais" <?php echo $categoria == 'Vegetais' ? 'selected' : ''; ?>>Vegetais e Legumes</option>
          <option value="Carnes" <?php echo $categoria == 'Carnes' ? 'selected' : ''; ?>>Carnes</option>
          <option value="Laticinios" <?php echo $categoria == 'Laticínios' ? 'selected' : ''; ?>>Laticínios</option>
          <option value="Ervas" <?php echo $categoria == 'Ervas' ? 'selected' : ''; ?>>Ervas</option>
          <option value="Cereais" <?php echo $categoria == 'Cereais' ? 'selected' : ''; ?>>Grãos e Cereais</option>
        </select>

        <div style="display: flex; justify-content:center; align-items:center;">
          <button type="submit" class="btn-adicionar">Filtrar</button>
        </div>
      </form>

      <h2>Selecione o Alimento</h2>

      <div style="display: flex; justify-content:center; align-items:center; flex-direction:column;">
        <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>

        <div class="food-option" onclick="carregarFormulario(<?php echo $row['id']; ?>)">
          <?php echo $row['nome_alimenticio']; ?>
        </div>

        <?php endwhile; ?>
        <?php else: ?>

        <p>Nenhum alimento encontrado.</p>

        <?php endif; ?>
      </div>
    </div>
  </main>
</body>
</html>
