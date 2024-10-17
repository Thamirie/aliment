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

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM alimentos WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Alimento não encontrado.");
    }
  } else {
    die("ID do alimento não especificado.");
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome_alimenticio"];
    $nome_cientifico = $_POST["nome_cientifico"];
    $caloria = $_POST["caloria"];
    $peso = $_POST["peso"];
    $proteinas = $_POST["proteinas"];
    $carboidratos = $_POST["carboidratos"];
    $potassio = $_POST["potassio"];
    $sodio = $_POST["sodio"];
    $colesterol = $_POST["colesterol"];
    $gorduras_totais = $_POST["gorduras_totais"];
    $categoria = $_POST["categoria"];
    $imagem_atual = $row["imagem"];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["imagem"]["name"]) {
        $check = getimagesize($_FILES["imagem"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Desculpe, o arquivo não é uma imagem válida.";
        } else {
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                // Remove a imagem antiga
                if (file_exists($imagem_atual)) {
                    unlink($imagem_atual);
                }
                $imagem = $target_file;
            } else {
                echo "Desculpe, ocorreu um erro ao enviar o arquivo.";
                $imagem = $imagem_atual;
            }
        }
    } else {
        $imagem = $imagem_atual;
    }

    $sql = "UPDATE alimentos SET nome_alimenticio = '$nome', nome_cientifico = '$nome_cientifico', caloria = $caloria, peso = $peso, proteinas = '$proteinas', carboidratos = '$carboidratos', potassio = $potassio, sodio = $sodio, colesterol = $colesterol, gorduras_totais = $gorduras_totais, categoria = '$categoria', imagem = '$imagem' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Alimento atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o alimento: " . $conn->error;
    }

    $conn->close();

    header("Location: alterar_ali.php");
    exit();
  }

  $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

  <title>Editar Alimento</title>

  <style>
    .form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .input_add {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
    }

    .btn-adicionar {
      padding: 10px 20px;
      background-color: #ffd59f;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .btn-adicionar:hover {
      background-color: #EDE3C8;
      border: 0.5px solid #6c6c6c;
      transition: all 0.2s linear;
    }
  </style>
</head>

<body style="background-color: #EDE3C8;">
  <main class="container">
    <a href="alterar_ali.php"><button class="btn-back">Voltar</button></a>

    <form method="post" enctype="multipart/form-data" class="form-container">
      <h2>Editar Alimento</h2>
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <div>
        <label for="nome" class="label">Nome:</label>
        <input type="text" id="nome_alimenticio" class="input_add" name="nome_alimenticio" value="<?php echo $row['nome_alimenticio']; ?>" required>
      </div>

      <div>
        <label for="nome_cientifico" class="label">Nome Científico:</label>
        <input type="text" id="nome_cientifico" class="input_add" name="nome_cientifico" value="<?php echo $row['nome_cientifico']; ?>" required>
      </div>

      <div>
        <label for="caloria" class="label">Calorias:</label>
        <input type="number" id="caloria" class="input_add" name="caloria" value="<?php echo $row['caloria']; ?>" required>
      </div>

      <div>
        <label for="peso" class="label">Peso (em gramas):</label>
        <input type="number" id="peso" class="input_add" name="peso" value="<?php echo $row['peso']; ?>" required>
      </div>

      <div>
        <label for="proteinas" class="label">Proteínas:</label>
        <input type="text" id="proteinas" class="input_add" name="proteinas" value="<?php echo $row['proteinas']; ?>" required>
      </div>

      <div>
        <label for="carboidratos" class="label">Carboidratos:</label>
        <input type="text" id="carboidratos" class="input_add" name="carboidratos" value="<?php echo $row['carboidratos']; ?>" required>
      </div>

      <div>
        <label for="potassio" class="label">Potássio:</label>
        <input type="number" id="potassio" class="input_add" name="potassio" value="<?php echo $row['potassio']; ?>" required>
      </div>

      <div>
        <label for="sodio" class="label">Sódio:</label>
        <input type="number" id="sodio" class="input_add" name="sodio" value="<?php echo $row['sodio']; ?>" required>
      </div>

      <div>
        <label for="colesterol" class="label">Colesterol:</label>
        <input type="number" id="colesterol" class="input_add" name="colesterol" value="<?php echo $row['colesterol']; ?>" required>
      </div>

      <div>
        <label for="gorduras_totais" class="label">Gorduras Totais:</label>
        <input type="number" id="gorduras_totais" class="input_add" name="gorduras_totais" value="<?php echo $row['gorduras_totais']; ?>" required>
      </div>

      <div>
        <label for="categoria" class="label">Categoria:</label>
        <select id="categoria" name="categoria" class="input_add" required>
          <option value="Frutas" <?php echo $row['categoria'] == 'Frutas' ? 'selected' : ''; ?>>Frutas</option>
          <option value="Vegetais" <?php echo $row['categoria'] == 'Vegetais' ? 'selected' : ''; ?>>Vegetais</option>
          <option value="Cereais" <?php echo $row['categoria'] == 'Cereais' ? 'selected' : ''; ?>>Cereais</option>
          <!-- Adicione mais opções conforme necessário -->
        </select>
      </div>

      <div>
        <label for="imagem" class="label">Imagem:</label>
        <input type="file" id="imagem" class="input_add" name="imagem">
      </div>

      <div style="display: flex; justify-content:center; align-items:center; margin:10px;">
        <button type="submit" class="btn-adicionar">Atualizar</button>
      </div>
    </form>
  </main>
</body>
</html>
