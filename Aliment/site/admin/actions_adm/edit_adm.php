<?php
  session_start();

  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../login-adm.php");
    exit();
  }

  $session_duration = 6 * 60 * 60; 
  $current_time = time();

  if (($current_time - $_SESSION["start_time"]) > $session_duration) {
    session_unset();
    session_destroy();
    setcookie("user_session", "", time() - 3600, "/");
    header("Location: ../login-adm.php");
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

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM administradores WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    } else {
      echo "Administrador não encontrado.";
      exit;
    }
  } else {
    echo "ID do administrador não fornecido.";
    exit;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome_completo = $_POST["nome_completo"];
    $formacao_academica = $_POST["formacao_academica"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $superioridade = $_POST["superioridade"];

    if ($conn->connect_error) {
      die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sql = "UPDATE administradores SET nome_completo='$nome_completo', formacao_academica='$formacao_academica', email='$email', senha='$senha', superioridade='$superioridade' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
      echo "Administrador atualizado com sucesso.";
    } else {
      echo "Erro ao atualizar o administrador: " . $conn->error;
    }

    $conn->close();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/bootstrap.min.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

    <title>Editar Administrador</title>

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

      .dropdown {
        position: relative;
        display: inline-block;
        width: 100%;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        width: 100%;
      }

      .dropdown-content div {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        cursor: pointer;
      }

      .dropdown-content div:hover {
        background-color: #f1f1f1;
      }

      .dropdown:hover .dropdown-content {
        display: block;
      }
    </style>
</head>

<body>
  <?php include '../../includes/cabecalho.php';?>

  <main class="container" style="display: flex; justify-content:center; align-items:center; padding: 25px;flex-direction:column;">
    <a href="../dashboard.php"><button class="btn-back">Voltar</button></a>

    <form method="post" class="div">
      <h2>Alterar Administrador</h2>
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <div>
        <label for="nome_completo" class="label">Nome Completo:</label>
        <input type="text" id="nome_completo" class="input_add" name="nome_completo" value="<?php echo $row['nome_completo']; ?>" required>
      </div>

      <div>
        <label for="formacao_academica" class="label">Formação Acadêmica:</label>
        <input type="text" id="formacao_academica" class="input_add" name="formacao_academica" value="<?php echo $row['formacao_academica']; ?>" required>
      </div>

      <div>
        <label for="superioridade" class="label">Superioridade:</label>
        <div class="dropdown">
            <div id="selected-superioridade" class="admin-option"><?php echo $row['superioridade']; ?></div>
            <div class="dropdown-content">
                <div onclick="selecionarSuperioridade('Alto')">Alto</div>
                <div onclick="selecionarSuperioridade('Médio')">Médio</div>
                <div onclick="selecionarSuperioridade('Baixo')">Baixo</div>
            </div>
        </div>
        <input type="hidden" name="superioridade" id="superioridade" value="<?php echo $row['superioridade']; ?>">
      </div>

      <div>
        <label for="email" class="label">Email:</label>
        <input type="email" id="email" name="email" class="input_add" value="<?php echo $row['email']; ?>" required>
      </div>

      <div>
        <label for="senha" class="label">Senha:</label>
        <input type="password" id="senha" class="input_add" name="senha" value="<?php echo $row['senha']; ?>" required>
      </div>

      <div style="display: flex; justify-content:center; align-items:center;">
        <button type="submit" class="btn-adicionar">Atualizar</button>
      </div>
    </form>
  </main>

  <script>
      function selecionarSuperioridade(nivel) {
          document.getElementById('selected-superioridade').textContent = nivel;
          document.getElementById('superioridade').value = nivel;
      }
  </script>
</body>
</html>
