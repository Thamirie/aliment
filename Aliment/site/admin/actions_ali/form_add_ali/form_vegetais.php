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
    $nomeve = $_POST["nomeve"];
    $nome_cientificove = $_POST["nome_cientificove"];
    $caloriave = $_POST["caloriave"];
    $pesove = $_POST["pesove"];
    $proteinasve = $_POST["proteinasve"];
    $carboidratosve = $_POST["carboidratosve"];
    $potassiove = $_POST["potassiove"];
    $sodiove = $_POST["sodiove"];
    $colesterolve = $_POST["colesterolve"];
    $gorduras_totaisve = $_POST["gorduras_totaisve"];
    $texturave = $_POST["texturave"];
    $tiposve = $_POST["tiposve"];
    $origem_botanicave = $_POST["origem_botanicave"];
    $caloriasve = $_POST["caloriasve"];
    $obs1ve = $_POST["obs1ve"];
    $obs2ve = $_POST["obs2ve"];
    $obs3ve = $_POST["obs3ve"];

    // Upload da imagem
    $target_dir = "/uploads/";
    $target_file = $target_dir . basename($_FILES["imagemve"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Tenta fazer o upload do arquivo
    if (move_uploaded_file($_FILES["imagemve"]["tmp_name"], $target_file)) {
        echo "O arquivo " . htmlspecialchars(basename($_FILES["imagemve"]["name"])) . " foi enviado com sucesso.";
    } else {
        echo "Desculpe, ocorreu um erro ao enviar o arquivo.";
    }

    // Preparando a consulta SQL para inserir os dados do vegetal no banco de dados
    $sql = "INSERT INTO vegetais (nomeve, nome_cientificove, caloriave, pesove, proteinasve, carboidratosve, potassiove, sodiove, colesterolve, gorduras_totaisve, imagemve, obs1ve, obs2ve, obs3ve, texturave, tiposve, origem_botanicave, caloriasve) 
            VALUES ('$nomeve', '$nome_cientificove', '$caloriave', '$pesove', '$proteinasve', '$carboidratosve', '$potassiove', '$sodiove', '$colesterolve', '$gorduras_totaisve', '$target_file', '$obs1ve', '$obs2ve', '$obs3ve', '$texturave', '$tiposve', '$origem_botanicave', '$caloriasve')";

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
  
  <h2>Adicionar Vegetal</h2>
  
  <!--NOME E NOME CIENTÍFICO-->
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div style="width: 100%; padding:5px;">
      <label for="nomeve" class="label">Nome:</label> 
      <input type="text" class="input_add" id="nomeve" name="nomeve" required>
    </div>
  
    <div style="width: 100%; padding:5px;">
      <label for="nome_cientificove" class="label">Nome Científico:</label>
      <input type="text" class="input_add" id="nome_cientificove" name="nome_cientificove" required>
    </div>
  </div>
  
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div style="width: 100%; padding: 5px;">
      <label for="obs1ve" class="label">Frase Inicial:</label>
      <input row="3" type="text" class="input_add" id="obs1ve" name="obs1ve" required>
    </div>
  
    <div style="width: 100%; padding: 5px;">
      <label for="obs2ve" class="label">Observação Inicial:</label>
      <textarea row="3" type="text" class="input_add" id="obs2ve" name="obs2ve"></textarea>
    </div>
  
    <div style="width: 100%; padding: 5px;">
      <label for="obs3ve" class="label">Observação Final:</label>
      <textarea row="3" type="text" class="input_add" id="obs3ve" name="obs3ve"></textarea>
    </div>
  </div>
  
  <!--PESO E PROTEÍNAS-->
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="pesove" class="label">Peso:</label>
      <input type="number" class="input_add" id="pesove" name="pesove" required placeholder="Em gramas">
    </div>
  
    <div style="width: 100%; padding:5px;">
      <label for="proteinasve" class="label">Proteínas:</label>
      <input type="text" class="input_add" id="proteinasve" name="proteinasve" required placeholder="Por 100 gramas">
    </div>
  </div>
  
  <!--cALORIAS-->
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="caloriave" class="label">Calorias:</label>
      <input type="number" class="input_add" id="caloriave" name="caloriave" required placeholder="Por 100 gramas">
    </div>
    
    <div style="width: 100%; padding:5px;">
      <label for="caloriasve"  class="label">Calorias:</label>
      <select class="input_add" id="caloriasve" name="caloriasve" required>
        <option value="alta caloria">Alta Caloria</option>
        <option value="baixa caloria">Baixa Caloria</option>
      </select>
    </div>
  </div>
  
  <!--CARBOIDRATOS E NUTRIENTES-->
  <div style="display: flex; justify-content:center; align-items:center; width:100%; padding: 5px;">
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="carboidratosve" class="label">Carboidratos:</label>
      <input type="text" class="input_add" id="carboidratosve" name="carboidratosve" required placeholder="Por 100 gramas">
    </div>
    
  </div>
  
  <!--POTÁSSIO E SÓDIO-->
  <div style="display: flex; justify-content:center; align-items:center;">
    <div style="width: 100%; padding:5px;">
      <label for="potassiove" class="label">Potássio:</label>
      <input type="number" class="input_add" id="potassiove" name="potassiove" required placeholder="Em miligramas por 100 gramas">
    </div>
  
    <div style="width: 100%; padding:5px;">
      <label for="sodiove" class="label">Sódio:</label>
      <input type="number" class="input_add" id="sodiove" name="sodiove" required placeholder="Em miligramas por 100 gramas">
    </div>
  </div>
  
  <!--COLESTEROL E GORDURAS TOTAIS-->
  <div style="display: flex; justify-content:center; align-items:center;">
    <div style="width: 100%; padding:5px;">
      <label for="colesterolve" class="label">Colesterol:</label>
      <input type="number" class="input_add" id="colesterolve" name="colesterolve" required placeholder="Em miligramas">
    </div>
  
    <div style="width: 100%; padding:5px;">
      <label for="gorduras_totaisve" class="label">Gorduras Totais:</label>
      <input type="text" class="input_add" id="gorduras_totaisve" name="gorduras_totaisve" required>
    </div>
  </div>
  
  <!-- ORIGEM BOTÂNICA E SABOR -->
  <div style="display: flex; justify-content:center; align-items:center;">
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="origem_botanicave" class="label">Origem Botânica:</label>
      <select class="input_add" id="origem_botanicave" name="origem_botanicave" required>
        <option value="temperado">Temperado</option>
        <option value="tropical">Tropical</option>
      </select>
    </div>
  
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="tiposve" class="label">Tipos de Vegetal:</label>
      <select class="input_add" id="tiposve" name="tiposve" required>
        <option value="folhosos">Folhoso</option>
        <option value="raiz">Raiz</option>
        <option value="bulbo">Bulbo</option>
        <option value="tuberculo">Tubérculo</option>
        <option value="flor">Flor</option>
        <option value="frutos">Fruto</option>
        <option value="legumes">Legume</option>
        <option value="caule">Caule</option>
      </select>
    </div>
  </div>
  
  <!--TEXTURA E IMAGEM-->
  <div style="display: flex; justify-content:center; align-items:center;">
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="texturave" class="label">Textura:</label>
      <select class="input_add" id="texturave" name="texturave" required>
        <option value="folhosos">Folhosos</option>
        <option value="raízes e tubérculos">Raízes e Tubérculos</option>
        <option value="flores">Flores</option>
        <option value="legumes">Legumes</option>
      </select>
    </div>
  
    <div class="form-group" style="width: 100%; padding:5px;">
      <label for="imagemve" class="label">Imagem:</label> <br>
      <input type="file" class="input_add" id="imagemve" name="imagemve" required>
    </div>
  
  </div>
  
  <div style="display: flex; justify-content:center; align-items:center;">
    <button type="submit" class="btn-adicionar">Adicionar</button>
  </div>
  
  </form>
</main>

</body>
</html>