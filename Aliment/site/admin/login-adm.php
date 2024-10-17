<?php
  $servername = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $dbname = "alimenth";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
  }

  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $email = $conn->real_escape_string($email);
    $senha = $conn->real_escape_string($senha);

    $sql = "SELECT * FROM administradores WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();

      $session_duration = 6 * 60 * 60;
      $_SESSION["loggedin"] = true;
      $_SESSION["email"] = $email;
      $_SESSION["superioridade"] = $row["superioridade"];
      $_SESSION["start_time"] = time();

      setcookie("user_session", session_id(), time() + $session_duration, "/");

      header("Location: dashboard.php");
      exit();
    } else {
      $login_err = "Credenciais inválidas. Por favor, tente novamente.";
    }
  }

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

  <title>Login de Administradores - Alimenth</title>
</head>

<body style="background-color: #EDE3C8;">
  <?php 
    include '../includes/juncaocc.php';
  ?>

  <main class="body" style="font-family: 'Times New Roman', Times, serif;">
    <form method="POST" class="div">
      <h2>Área de Login do Administrador</h2>
        <div class="form-group">
          <label for="email" class="label">Email:</label> <br>
          <input type="email" id="email" class="input_add" name="email" required>
        </div>

        <div class="form-group">
          <label for="senha" class="label">Senha:</label> <br>
          <input type="password" id="senha" name="senha" class="input_add" required>
        </div>

        <div style="display: flex; justify-content:center; align-items:center; margin:10px;">
          <button class="btn-log" type="submit">Login</button>
        </div>

      </form>
  </main>
</body>
</html>