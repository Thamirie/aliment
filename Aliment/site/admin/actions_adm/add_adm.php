<?php 
  function verificarAcesso() {
    session_start();
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
      header("location: ../login-adm.php");
      exit;
    }

    if ($_SESSION["superioridade"] == "Baixo") {
      include 'pagina-erro.php';
      exit;
    }
  }

  verificarAcesso();

  $session_duration = 6 * 60 * 60; // 6 horas em segundos
  $current_time = time();

  if (($current_time - $_SESSION["start_time"]) > $session_duration) {
    session_unset();
    session_destroy();
    setcookie("user_session", "", time() - 3600, "/"); 
    header("Location: ../login-adm.php");
    exit();
  }

  $email = $_SESSION["email"];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_completo = $_POST["nome_completo"];
    $formacao_academica = $_POST["formacao_academica"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    if ($senha !== $confirmar_senha) {
      echo "<h6 style='color: red;'>As senhas não correspondem.</h6>";
      exit;
    }

    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "alimenth";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sql = "INSERT INTO administradores (nome_completo, formacao_academica, email, senha) VALUES ('$nome_completo', '$formacao_academica', '$email', '$senha')";

    if ($conn->query($sql) === TRUE) {
      header("Location: ../dashboard.php");
      exit();
    } else {
        echo "Erro ao adicionar o administrador: " . $conn->error;
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

  <title>Adicionar Administrador</title>
</head>

<body style="background-color: #EDE3C8;">
  <?php include '../../includes/cabecalho.php';?>

  <main class="container" style="display: flex; justify-content:center; align-items:center; padding: 25px;flex-direction:column;">
    <a href="../dashboard.php"><button class="btn-back">Voltar</button></a>

    <form method="post" class="div" style="display: flexbox; justify-content:center; align-items:center;">
      <h2>Adicionar Administrador</h2>

      <div style="width: 100%; padding:5px;">
        <label for="nome_completo" class="label">Nome Completo:</label> <br>
        <input type="text" id="nome_completo" name="nome_completo" class="input_add" required>
      </div>

      <div style="width: 100%; padding:5px;">
        <label for="formacao_academica" class="label">Formação Acadêmica:</label> <br>
        <input type="text" id="formacao_academica" name="formacao_academica" class="input_add" required>
      </div>

      <div style="width: 100%; padding:5px;">
        <label for="email" class="label">Email:</label> <br>
        <input type="email" id="email" name="email" class="input_add" required>
      </div>

      <div style="width: 100%; padding:5px;">
        <label for="senha" class="label">Senha:</label> <br>
        <input type="password" id="senha" name="senha" class="input_add" required>
      </div>

      <div style="width: 100%; padding:5px;">
        <label for="confirmar_senha" class="label">Confirmar Senha:</label> <br>
        <input type="password" id="confirmar_senha" name="confirmar_senha" class="input_add" required>
      </div>

      <div style="display: flex; justify-content:center; align-items:center; margin:10px;">
        <button type="submit" class="btn-adicionar">Adicionar</button>
      </div>
    </form>
  </main>

</body>
</html>