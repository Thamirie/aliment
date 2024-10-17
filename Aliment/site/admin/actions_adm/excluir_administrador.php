<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "alimenth";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
  }

  if (isset($_GET['id'])) {
    $adminId = $_GET['id'];

    $sql = "DELETE FROM administradores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $adminId);

    if ($stmt->execute()) {
        echo "Administrador excluído com sucesso.";
    } else {
        echo "Erro ao excluir o administrador: " . $conn->error;
    }

    $stmt->close();
  } else {
    echo "ID do administrador não fornecido.";
  }

  $conn->close();

  header("Location: excluir_adm.php");
  exit();
?>
