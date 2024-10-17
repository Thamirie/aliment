<?php
  $servername = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $dbname = "alimenth";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM carnes";

  $result = $conn->query($sql);

  if ($result === false) {
    die("Erro na consulta ao banco de dados: " . $conn->error);
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="stylesheet" href="/src/bootstrap.bundle.js">
  <link rel="stylesheet" href="/css/categorias.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">

  <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

  <title>Frutas - Aliment</title>
</head>

<body style="background-color: #EDE3C8; font-family:'Times New Roman', Times, serif;">
  <?php 
    include '../includes/juncaocc.php';
    include '../includes/filtro_carnes.php';
  ?>

  <main class="container" style="display:flex; align-items:center; justify-content:center; overflow:hidden;">
    <div class="row grid">
      <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card" data-toggle="modal" data-target="#modal_<?php echo $row['id']; ?>">
        <img src="<?php echo $row['imagem']; ?>" class="card-img-top" alt="<?php echo $row['nome']; ?>">
        <div class="card-body">
          <h5 class="card-title"><?php echo $row['nome']; ?></h5>
          <p class="card-text"> <?php echo $row['nome_cientifico']; ?></p>
          <p class="card-text"> <?php echo $row['obs1']; ?></p>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div style="background-color: #EDE3C8;" class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo $row['nome']; ?></h5>
              <h6><?php echo $row['nome_cientifico'];?></h6>
              <button type="button" class="close btn-closed" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div style="display: flex;">
                <img src="<?php echo $row['imagem']; ?>" class="img-fluid" alt="<?php echo $row['nome']; ?>">
                <div>
                  <p><?php echo $row['obs1']; ?></p>
                  <p><?php echo $row['obs2']; ?></p>
                  <p><?php echo $row['obs3'];?></p>
                </div>
              </div>

              <div>
                <ul type="none">
                  <li><b>Caloria:  </b><?php echo $row['caloria']; ?></li>
                  <li><b>Peso: </b><?php echo $row['peso'];?></li>
                  <li><b>Proteínas: </b><?php echo $row['proteinas'];?></li>
                  <li><b>Carboidratos: </b><?php echo $row['carboidratos'];?></li>
                  <li><b>Potássio: </b><?php echo $row['potassio'];?></li>
                  <li><b>Sódio: </b><?php echo $row['sodio'];?></li>
                  <li><b>Colesterol: </b><?php echo $row['colesterol'];?></li>
                  <li><b>Gorduras Totais: </b><?php echo $row['gorduras_totais'];?></li>
                </ul>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn-closed" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>

      <?php endwhile; ?>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>