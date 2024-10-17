<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "alimenth";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
  }

  $sql = "SELECT id, nome_completo, formacao_academica, email, superioridade FROM administradores";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="stylesheet" href="/css/admin.css">
  <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

  <title>Lista de Administradores</title>

  <style>
    .diva{
      background-color: #f4bd75;
      margin: auto;
      width: 95%;
      padding: 20px;
      border-radius: 3px;
      justify-content: center;
      align-items: center;
    }

    .diva h2{
      text-align: center;
      color: #000000;
      font-family: 'Times New Roman', Times, serif;
      text-transform: uppercase;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
      background-color: #ffd59f;
      text-transform: uppercase;
      font-family: 'Times New Roman', Times, serif;
      text-align: center;
    }

    th {
      background-color: #FA8E51;
      text-transform: uppercase;
      font-family: 'Times New Roman', Times, serif;
      font-weight: bold;
    }

    tr:hover{
      background-color: #FA8E51;
      border: 1px solid #6c6c6c;
    }
  </style>
</head>

<body style="background-color: #EDE3C8;">
  <?php include '../../includes/cabecalho.php';?>

  <main class="container" style="display: flex; justify-content:center; align-items:center; padding: 25px;flex-direction:column;">
    <a href="../dashboard.php"><button class="btn-back">Voltar</button></a>

    <div class="diva">

      <h2>Lista de Administradores</h2>
      <table>
        <thead>
          <tr style="text-align: center;">
            <th>ID</th>
            <th style="width: 50%;">Nome Completo</th>
            <th>Formação Acadêmica</th>
            <th>Email</th>
            <th>Superioridade</th>
          </tr>
        </thead>

        <tbody>
          <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome_completo']; ?></td>
            <td><?php echo  $row['formacao_academica']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['superioridade']; ?></td>

          </tr>

          <?php endwhile; ?>
          <?php else: ?>

          <tr>
            <td colspan="3">Nenhum administrador encontrado.</td>
          </tr>

          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>

<?php $conn->close(); ?>
