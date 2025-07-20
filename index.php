<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acolhe Food</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="logoacolhe.png" type="image/x-icon">
</head>
<body>

  <header>
    <h1>Acolhe Food</h1>
    <p>Seu guia para uma alimentação equilibrada voltada para pessoas atípicas</p>
  </header>

  <nav>
    <a href="#sobre">Sobre</a>
    <a href="#dicas">Dicas</a>
    <a href="#contato">Contato</a>
    <a href="planos.php">Planos</a>
  </nav>

  <section id="sobre">
    <h2>Sobre Nós</h2>
    <p>Temos a proposta de transformar a alimentação em uma experiência segura, positiva e adaptada para cada mente e necessidade.</p>
  </section>

  <section id="dicas">
    <h2>Dicas de Nutrição</h2>
    <div class="cards">
      <div class="card">
        <img src="https://via.placeholder.com/280x160.png?text=Frutas+Frescas" alt="Frutas Frescas">
        <h3>Consuma Frutas</h3>
        <p>Frutas frescas são fontes naturais de vitaminas, fibras e antioxidantes.</p>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/280x160.png?text=Hidratação" alt="Hidratação">
        <h3>Hidrate-se</h3>
        <p>A água é essencial para o funcionamento do corpo e para o bem-estar mental.</p>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/280x160.png?text=Refeições+Equilibradas" alt="Refeições Equilibradas">
        <h3>Refeições Balanceadas</h3>
        <p>Combine carboidratos, proteínas e gorduras boas para manter a energia e a concentração.</p>
      </div>
    </div>
  </section>

  <section id="contato">
    <h2>Contato</h2>
    <p>Email: <a href="mailto:contato@acolhefood.com">contato@acolhefood.com</a></p>
  </section>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Acolhe Food. Todos os direitos reservados.</p>
    <a href="https://www.instagram.com/acolhefood.cie?igsh=ajdoYzM3dW1sMHF1" target="_blank">
      <img id="simboloInsta" src="simbolo_insta.png" alt="Instagram Acolhe Food">
    </a>
  </footer>

</body>
</html>

