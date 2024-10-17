<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/bootstrap.min.css">
  <link rel="shortcut icon" href="/img/circle-logo-favicon.png" type="image/x-icon">

  <title>Info - Alimenth</title>

  <style>
    h1{
      font-family: Raillinc; 
      text-align:center; 
      margin: 15px;
    }

    p, li{
      padding: 0 80px;
    }

    .circle {
      margin: 20px 10px;
      border-radius: 15px;
      width: 150px; /* Ajuste o tamanho conforme necessário */
      height: 150px; /* Ajuste o tamanho conforme necessário */
      object-fit: cover;
    }

    figure {
      margin: 0;
    }

    .image-container {
      flex: 0 0 auto;
    }
  </style>
</head>

<body style="background-color: #EDE3C8;">
  <?php 
    include 'includes/juncaocc.php';
  ?>

  <main class="container" style="font-family: 'Times New Roman', Times, serif; padding: 25px; font-size: 20px;">
    <h1>Informações Importantes</h1>

    <p>Bem-vindo ao Aliment, sua fonte confiável de informações sobre alimentos e nutrição! Como parte da nossa missão de promover escolhas alimentares saudáveis e informadas, gostaríamos de compartilhar alguns avisos importantes para garantir que você aproveite ao máximo a sua experiência conosco:</p>

    <ul type="none">
      <li><b>Fonte de Informações:</b> O Aliment fornece informações sobre alimentos e nutrição baseadas em evidências científicas. No entanto, é importante lembrar que as informações fornecidas são para fins educacionais e não devem substituir o conselho personalizado de um profissional de saúde qualificado.</li>

      <li><b>Variação Nutricional:</b> Os valores nutricionais dos alimentos podem variar com base em vários fatores, como a forma de preparo, a origem e a sazonalidade. Sempre consulte os rótulos dos alimentos e verifique as informações nutricionais atualizadas.</li>

      <li><b>Alergias e Restrições Alimentares:</b> Se você possui alergias alimentares ou segue uma dieta restritiva, verifique sempre os ingredientes dos alimentos e consulte um profissional de saúde para obter orientação personalizada.</li>

      <li><b>Segurança dos Alimentos:</b> O Aliment não pode garantir a segurança dos alimentos ou produtos mencionados no site. Certifique-se de seguir as práticas adequadas de armazenamento, preparo e manipulação de alimentos para reduzir o risco de doenças alimentares.</li>

      <li><b>Feedback e Dúvidas:</b> Valorizamos seu feedback e estamos aqui para responder às suas perguntas. Se você tiver alguma dúvida, comentário ou preocupação, entre em contato conosco através dos nossos canais de comunicação disponíveis.</li>
    </ul>

    <section style="display: flex; justify-content: center; align-items: center;">
      <div class="image-container">
        <figure>
          <img src="/img/bg-framboesa.jpeg" alt="Framboesas" class="circle">
        </figure>
      </div>

      <div class="image-container">
        <figure>
          <img src="/img/bg-morango.jpeg" alt="Morangos" class="circle">
        </figure>
      </div>

      <div class="image-container">
        <figure>
          <img src="/img/bg-pessego.jpeg" alt="Pêssegos" class="circle">
        </figure>
      </div>

      <div class="image-container">
        <figure>
          <img src="/img/bg-laranja.jpeg" alt="Laranjas" class="circle">
        </figure>
      </div>

      <div class="image-container">
        <figure>
          <img src="/img/bg-banana.jpeg" alt="Bananas" class="circle">
        </figure>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php';?>
</body>
</html>