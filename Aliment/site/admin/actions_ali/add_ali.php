<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: ../login-adm.php");
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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="stylesheet" href="/css/dashboard.css">
  <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

  <title>Adicionar Alimentos</title>

  <style>
    .select-button {
      margin: 5px 0 10px;
      background-color: #FA8E51;
      width: 30%;
      padding: 10px 15px;
      border-radius: 3px;
      border: none;
      font-family: 'Times New Roman', Times, serif;
      text-transform: uppercase;
      cursor: pointer;
      text-align: center;
    }

    .select-button:hover {
      background-color: #EDE3C8;
      width: 60%;
      cursor: pointer;
      transition: all 1s linear;
    }

    .category-button {
      margin: 5px;
      background-color: #f4bd75;
      font-family: 'Times New Roman', Times, serif;
      text-transform: uppercase;
      border: none;
      padding: 8px 5px;
      border-radius: 3px;
      width: 180px;
      text-align: center;
    }

    .category-button:hover {
      background-color: #EDE3C8;
      transition: all 0.5s linear;
    }

    .form-container, .category-buttons {
      display: none;
    }

    .circles {
      margin: 5px;
      border-radius: 15px;
      width: 150px;
      height: 150px;
      object-fit: cover;
    }
  </style>

  <script>
    function mostrarCategorias() {
      document.getElementById('categoria-buttons').style.display = 'block';
    }
  </script>
</head>

<body style="background-color: #EDE3C8;">
  <?php include '../../includes/juncaocc.php';?>

  <main class="container" style="display: flex; justify-content:center; align-items:center; padding: 25px; flex-direction:column;">
    <a href="../dashboard.php"><button class="btn-back">Voltar</button></a>

    <h2 style="font-family: 'Times New Roman', Times, serif; text-transform:uppercase;">Selecione a categoria</h2>

    <label for="categoria" style="display: none;">Selecione a categoria:</label>
    <div style="width: 70%; display:flex; justify-content:center; align-items:center;">
      <div class="select-button" onclick="mostrarCategorias()">Selecionar</div>
    </div>

    <div id="categoria-buttons" class="category-buttons">
      <div style="display: flex; justify-content:center; align-items:center;">

        <a href="form_add_ali/form_frutas.php">
          <div class="category-button image-container">
            <figure><img src="/img/bg-frutas.jpeg" alt="Frutas" class="circles"></figure>
            <button>Frutas</button>
          </div>
        </a>

        <a href="form_add_ali/form_vegetais.php">
          <div class="category-button image-container">
            <figure><img src="/img/bg-vegetais.jpeg" alt="Vegetais" class="circles"></figure>
            <button>Vegetais</button>
          </div>
        </a>

        <a href="form_add_ali/form_carnes.php">
          <div class="category-button image-container" onclick="mostrarFormulario('carnes')">
            <figure><img src="/img/bg-carnes.jpeg" alt="Carnes" class="circles"></figure>
            <button>Carnes</button>
          </div>
        </a>
      </div>

      <div style="display: flex; justify-content:center; align-items:center;">
        <div class="category-button image-container" onclick="mostrarFormulario('laticinios')">
          <figure><img src="/img/bg-laticinios.jpeg" alt="Laticínios" class="circles"></figure>
          <p>Laticínios</p>
        </div>

        <div class="category-button image-container" onclick="mostrarFormulario('cereais')">
          <figure><img src="/img/bg-cereais.jpeg" alt="Grãos e Cereais" class="circles"></figure>
          <p>Grãos e Cereais</p>
        </div>

        <div class="category-button image-container" onclick="mostrarFormulario('ervas')">
          <figure><img src="/img/bg-ervas.jpeg" alt="Ervas" class="circles"></figure>
          <p>Ervas</p>
        </div>
      </div>
    </div>

    <!-- Cada div a seguir exibe um formulário específico para a categoria selecionada -->
    <div id="form_frutas" style="display:none;" class="form-container">
      <!-- Formulário para Frutas -->
      <?php include 'formularios/form_frutas.php'; ?>
    </div>

    <div id="form_vegetais" style="display:none;" class="form-container">
      <!-- Formulário para Vegetais -->
      <?php include 'formularios/form_vegetais.php'; ?>
    </div>

    <div id="form_carnes" style="display:none;" class="form-container">
      <!-- Formulário para Carnes -->
      <?php include 'formularios/form_carnes.php'; ?>
    </div>

    <div id="form_laticinios" style="display:none;" class="form-container">
      <!-- Formulário para Laticínios -->
      <?php include 'formularios/form_laticinios.php'; ?>
    </div>

    <div id="form_cereais" style="display:none;" class="form-container">
      <!-- Formulário para Grãos e Cereais -->
      <?php include 'formularios/form_cereais.php'; ?>
    </div>

    <div id="form_ervas" style="display:none;" class="form-container">
      <!-- Formulário para Ervas -->
      <?php include 'formularios/form_ervas.php'; ?>
    </div>
  </main>
</body>
</html>
