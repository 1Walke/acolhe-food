<?php
include "protect.php";


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acolhe Food</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="logo2.png" type="image/x-icon">

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
<body>

<header>
  <nav class="nav-bar">
    <div class="logo">
      <h1>Acolhe Food</h1>
    </div>
    <div class="nav-list">
      <ul>
        <li class="nav-item"><a href="minhaConta/minhaConta.php" class="nav-link">Minha Conta</a></li>
                    <li class="nav-item"><a href="minhaConta/receitas/minhaAssinatura.php" class="nav-link">Minha Assinatura</a></li>
                    <li class="nav-item"><a href="planos/planos.php" class="nav-link" id="planosAss">Planos de Assinatura</a></li>
                    <?php echo $_SESSION['admin'] >= 1 ?  '<li class="nav-item"><a href="admin/postarReceita.php" class="nav-link">Gerenciar Receitas</a></li>' : ""; ?>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Sair</a></li>
      </ul>
    </div>
    <div class="login-button">
      <button><a href="minhaConta/minhaConta.php"><?php echo $_SESSION['nome'] ?></a></button>
    </div>
    <div class="mobile-menu-icon">
      <button onclick="menuShow()"><img class="icon" src="menu_white_36dp.svg" alt="menu"></button>
    </div>
  </nav>
  <div class="mobile-menu">
    <ul>
      <li class="nav-item"><a href="minhaConta/minhaConta.php" class="nav-link">Minha Conta</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Minha Assinatura</a></li>
                    <li class="nav-item"><a href="planos/planos.php" class="nav-link" id="planosAss">Planos de Assinatura</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Sair</a></li>
    </ul>
    <div class="login-button">
      <button><a href="minhaConta/minhaConta.php"><?php echo $_SESSION['nome'] ?></a></button>
    </div>
  </div>
</header>

<section id="sobre">
  <h2>Sobre Nós</h2>
  <p>
    No Acolhe Food, acreditamos que alimentação saudável deve ser acessível, prazerosa e adaptada às necessidades de cada pessoa.<br>
    Entendemos os desafios da seletividade alimentar e sabemos como ela pode impactar a saúde e o bem-estar. Por isso, oferecemos apoio, orientações e recursos práticos para ajudar você a ampliar seu repertório alimentar de forma gradual e respeitosa.<br>
    Nosso objetivo é inspirar mudanças positivas através de dicas nutricionais confiáveis, estratégias personalizadas e conteúdos que promovam o equilíbrio entre corpo e mente. Aqui, cada passo rumo a uma alimentação mais variada é celebrado — porque saúde se constrói com paciência, conhecimento e acolhimento.
  </p>
</section>

<section id="dicas">
  <h2>Dicas de Nutrição</h2>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">

      <div class="swiper-slide card">
        <img src="tartarugaDeKiwi.JPG" alt="Tartarugas de Kiwi">
        <h3>Frutas Divertidas</h3>
        <p>Transforme kiwis e uvas em pequenas tartarugas para incentivar o consumo de frutas.</p>
      </div>

      <div class="swiper-slide card">
        <img src="cachorroDeMorango.JPG" alt="Cachorro de Morango">
        <h3>Pet de Morango</h3>
        <p>Morangos e mirtilos viram um lanchinho lúdico e saudável.</p>
      </div>

      <div class="swiper-slide card">
        <img src="cachorroDeArroz.JPG" alt="Cachorro de Arroz">
        <h3>Arroz Criativo</h3>
        <p>Prato decorado com arroz e vegetais para uma refeição divertida e nutritiva.</p>
      </div>

      <div class="swiper-slide card">
        <img src="bonecoDeArroz.JPG" alt="Boneco de Arroz">
        <h3>Bonequinho de Arroz</h3>
        <p>Combinação de arroz e legumes em um prato cheio de cor e saúde.</p>
      </div>

      <div class="swiper-slide card">
        <img src="bonecoDeSalada.JPG" alt="Boneco de Salada">
        <h3>Boneco de Salada</h3>
        <p>Salada criativa para alegrar e incentivar uma alimentação equilibrada.</p>
      </div>

      <div class="swiper-slide card">
        <img src="comidaArrozPorco.JPG" alt="Galinho no Curry">
        <h3>Porquinho no Curry</h3>
        <p>Prato divertido com arroz em forma de porquinho e legumes ao curry.</p>
      </div>

      <div class="swiper-slide card">
        <img src="comidaFelizMelhor.JPG" alt="Carinha Feliz">
        <h3>Carinha Feliz</h3>
        <p>Refeição colorida com arroz, frango grelhado e vegetais frescos.</p>
      </div>

      <div class="swiper-slide card">
        <img src="ComidaFofinha.JPG" alt="Galinho Duplo">
        <h3>Galinho Duplo</h3>
        <p>Duas porções de arroz decoradas como galinhos sobre um delicioso curry.</p>
      </div>

      <div class="swiper-slide card">
        <img src="comidaPaisagem.JPG" alt="Paisagem no Prato">
        <h3>Paisagem no Prato</h3>
        <p>Arroz, feijão e vegetais formando um cenário ensolarado e alegre.</p>
      </div>

    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<section id="contato">
  <h2>Contato</h2>
  <p>Email: <a href="mailto:contato@acolhefood.com">acolhefood@gmail.com</a></p>
</section>

<footer>
  <p>&copy; <?php echo date("Y"); ?> Acolhe Food. Todos os direitos reservados.</p>
  <a href="https://www.instagram.com/acolhefood.cie?igsh=ajdoYzM3dW1sMHF1" target="_blank">
    <img id="simboloInsta" src="simbolo_insta.png" alt="Instagram Acolhe Food">
  </a>
</footer>
<?php

if($_GET["vl"] == 1){
  echo "<script>
  document.querySelector('#planosAss').style.display = 'none';
  </script>";
}

?>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: false,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      0: { slidesPerView: 1.5 },
      768: { slidesPerView: 5 },
      1024: { slidesPerView: 8 }
    }
  });

  function menuShow(){
    let menuMobile = document.querySelector('.mobile-menu');
    let icon = document.querySelector('.icon');
    if(menuMobile.classList.contains('open')){
        menuMobile.classList.remove('open');
        icon.src = "menu_white_36dp.svg";
    }
    else{
        menuMobile.classList.add('open');
        icon.src = "close_white_36dp.svg";
    }
  }
</script>

</body>
</html>