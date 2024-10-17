<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: ../../login-adm.php");
  exit();
}

$session_duration = 6 * 60 * 60; // 6 horas em segundos
$current_time = time();

if (($current_time - $_SESSION["start_time"]) > $session_duration) {
  session_unset();
  session_destroy();
  setcookie("user_session", "", time() - 3600, "/"); // Expirar o cookie
  header("Location: ../../login-adm.php");
  exit();
}

$email = $_SESSION["email"];

  // Verifica se o formulário foi enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $servername = "localhost"; // Altere conforme o seu servidor
    $username = "root"; // Altere conforme o seu usuário
    $password = ""; // Altere conforme a sua senha
    $dbname = "alimenth";

    // Criando a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificando a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Dados do formulário
    $nome = $_POST["nome"];
    $nome_cientifico = $_POST["nome_cientifico"];
    $caloria = $_POST["caloria"];
    $peso = $_POST["peso"];
    $proteinas = $_POST["proteinas"];
    $carboidratos = $_POST["carboidratos"];
    $potassio = $_POST["potassio"];
    $sodio = $_POST["sodio"];
    $colesterol = $_POST["colesterol"];
    $gorduras_totais = $_POST["gorduras_totais"];
    $tipo = $_POST["tipo"];
    $obs1 = $_POST["obs1"];
    $obs2 = $_POST["obs2"];
    $obs3 = $_POST["obs3"];

    // Upload da imagem
    $target_dir = "/uploads/";
    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Tenta fazer o upload do arquivo
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
        echo "O arquivo " . htmlspecialchars(basename($_FILES["imagem"]["name"])) . " foi enviado com sucesso.";
    } else {
        echo "Desculpe, ocorreu um erro ao enviar o arquivo.";
    }

    // Preparando a consulta SQL para inserir os dados do vegetal no banco de dados
    $sql = "INSERT INTO carnes (nome, nome_cientifico, caloria, peso, proteinas, carboidratos, potassio, sodio, colesterol, gorduras_totais, imagem, obs1, obs2, obs3, tipo) 
            VALUES ('$nome', '$nome_cientifico', '$caloria', '$peso', '$proteinas', '$carboidratos', '$potassio', '$sodio', '$colesterol', '$gorduras_totais', '$target_file', '$obs1', '$obs2', '$obs3', '$tipo')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso.";
    } else {
        echo "Erro ao inserir o registro: " . $conn->error;
    }

    // Fechar a conexão
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

  <title>Document</title>
</head>
<body style="background-color: #EDE3C8;">

<?php include '../../../includes/juncaocc.php';?>

<main class="container" style="display: flex; justify-content:center; align-items:center; padding: 25px; flex-direction:column;">
  <a href="../add_ali.php"><button class="btn-back">Voltar</button></a>
  
  <form method="post" enctype="multipart/form-data" class="div">
  
  <h2>Adicionar Carne</h2>
  
  <!--NOME E NOME CIENTÍFICO-->
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div style="width: 100%; padding:5px;">
      <label for="nome" class="label">Nome:</label> 
      <input type="text" class="input_add" id="nome" name="nome" required>
    </div>
  
    <div style="width: 100%; padding:5px;">
      <label for="nome_cientifico" class="label">Nome Científico:</label>
      <input type="text" class="input_add" id="nome_cientifico" name="nome_cientifico" required>
    </div>
  </div>
  
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div style="width: 100%; padding: 5px;">
      <label for="obs1" class="label">Frase Inicial:</label>
      <input row="3" type="text" class="input_add" id="obs1" name="obs1" required>
    </div>
  
    <div style="width: 100%; padding: 5px;">
      <label for="obs2" class="label">Observação Inicial:</label>
      <textarea row="3" type="text" class="input_add" id="obs2" name="obs2"></textarea>
    </div>
  
    <div style="width: 100%; padding: 5px;">
      <label for="obs3" class="label">Observação Final:</label>
      <textarea row="3" type="text" class="input_add" id="obs3" name="obs3"></textarea>
    </div>
  </div>
  
  <!--PESO E PROTEÍNAS-->
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="peso" class="label">Peso:</label>
      <input type="number" class="input_add" id="peso" name="peso" required placeholder="Em gramas">
    </div>
  
    <div style="width: 100%; padding:5px;">
      <label for="proteinas" class="label">Proteínas:</label>
      <input type="text" class="input_add" id="proteinas" name="proteinas" required placeholder="Por 100 gramas">
    </div>
  </div>
  
  <!--cALORIAS E CARBOIDRATOS-->
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="caloria" class="label">Calorias:</label>
      <input type="number" class="input_add" id="caloria" name="caloria" required placeholder="Por 100 gramas">
    </div>

    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="carboidratos" class="label">Carboidratos:</label>
      <input type="text" class="input_add" id="carboidratos" name="carboidratos" required placeholder="Por 100 gramas">
    </div>
  </div>
  
  <!--POTÁSSIO E SÓDIO-->
  <div style="display: flex; justify-content:center; align-items:center;">
    <div style="width: 100%; padding:5px;">
      <label for="potassio" class="label">Potássio:</label>
      <input type="number" class="input_add" id="potassio" name="potassio" required placeholder="Em miligramas por 100 gramas">
    </div>
  
    <div style="width: 100%; padding:5px;">
      <label for="sodio" class="label">Sódio:</label>
      <input type="number" class="input_add" id="sodio" name="sodio" required placeholder="Em miligramas por 100 gramas">
    </div>
  </div>
  
  <!--COLESTEROL E GORDURAS TOTAIS-->
  <div style="display: flex; justify-content:center; align-items:center;">
    <div style="width: 100%; padding:5px;">
      <label for="colesterol" class="label">Colesterol:</label>
      <input type="number" class="input_add" id="colesterol" name="colesterol" required placeholder="Em miligramas">
    </div>
  
    <div style="width: 100%; padding:5px;">
      <label for="gorduras_totais" class="label">Gorduras Totais:</label>
      <input type="text" class="input_add" id="gorduras_totais" name="gorduras_totais" required>
    </div>
  </div>
  
  <!-- TIPO DE CARNE -->
  <div style="display: flex; justify-content:center; align-items:center;">
  
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="tipo" class="label">Tipos de Carne:</label>
      <select class="input_add" id="tipo" name="tipo" required>
        <option value="Carne Vermelha">Carne Vermelha</option>
        <option value="Carne Branca">Carne Branca</option>
        <option value="Carne de Caça">Carne de Caça</option>
        <option value="Carne Processada">Carne Processada</option>
        <option value="Frutos do Mar">Frutos do Mar</option>
        <option value="Carne Exótica">Carne Exótica</option>
      </select>
    </div>

    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="imagem" class="label">Imagem:</label> <br>
      <input type="file" class="input_add" id="imagem" name="imagem" required>
    </div>
  
  </div>
  
  <div style="display: flex; justify-content:center; align-items:center;">
    <button type="submit" class="btn-adicionar">Adicionar</button>
  </div>
  
  </form>
</main>

</body>
</html>