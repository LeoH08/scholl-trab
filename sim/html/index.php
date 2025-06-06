<?php
function get_that_filetime($file_url = false)
{
  if (!file_exists($file_url)) {
    return '';
  }

  return filemtime($file_url);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="manifest" href="/site.webmanifest" />
  <link rel="stylesheet" href="../css/stylelayout.css?<?php echo get_that_filetime('../css/admin.css'); ?>" />
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
    rel="stylesheet" />
  <!-- <link rel="stylesheet" href="../css/cabeçalhoerodape.css" /> -->
  <title>EETAN | Site Oficial</title>
</head>

<body>
  <header class="content">
    <div class="logo">
      <a href="../html/index.php">
        <img src="../fts/Logo_EETAN.png" alt="logo_escola" />
        <h3>EETAN</h3>
      </a>
    </div>
    <nav>
      <ul class="list-menu">
        <li><a href="../html/sobre.php">Sobre</a></li>
        <li><a href="../html/cursos.php">Cursos</a></li>
        <li><a href="../html/direcao.php">Direção</a></li>
        <li><a href="../html/CorpoDocente.php">Professores</a></li>
        <li><a href="../html/matricula.php">Matricula</a></li>
        <li><a href="../html/boletim.php">Boletim</a></li>
        <li>
          <a href="../html/cadastro.php">
            <i class="bi bi-person-circle"></i>
          </a>
        </li>
      </ul>
    </nav>
  </header>
  <section class="first-section">
    <div class="conteudo-principal">
      <div class="slideshow-container">
        <img
          class="slides"
          src="../fts/Volta_as_aulas.png"
          alt="Volta as aulas" />
        <img
          class="slides"
          src="../fts/Semana_de_Provas.png"
          alt="Semana de provas" />
        <img
          class="slides"
          src="../fts/Novembro_Azul.png"
          alt="Novembro Azul" />

        <div class="progress-bar"></div>
      </div>
    </div>
  </section>

  <section class="sobre-nos" id="sobrenos">
    <div class="main">
      <div class="contentsobre">
        <h2>História</h2>
        <p>
          A Escola Estadual Tancredo de Almeida Neves, estabelecida em 1977
          sob o nome de Escola Estadual Alberto Giovannini, tem uma trajetória
          marcada pelo compromisso com a educação e o desenvolvimento da
          comunidade. Localizada em Coronel Fabriciano, Minas Gerais, a
          instituição mudou-se para seu atual prédio em 1985, sendo rebatizada
          em 2011 em homenagem ao ex-presidente Tancredo Neves. Ao longo de
          sua história, a escola ampliou suas ofertas de ensino, incluindo o
          Ensino Médio, a Educação de Jovens e Adultos (EJA) e, mais
          recentemente, os cursos técnicos em Desenvolvimento de Sistemas e
          Logística. Com uma dedicação constante à qualidade educacional e à
          inclusão, a Escola Tancredo Neves se consolida como um importante
          alicerce para o desenvolvimento pessoal e profissional de seus
          alunos, promovendo a valorização e o progresso da comunidade local.
        </p>
      </div>
      <div class="img-eetan">
        <img src="../fts/Logo_EETAN.png" alt="Imagem da Escola" />
      </div>
    </div>
  </section>

  <section class="contatos" id="contatos">
    <h3>Contatos</h3>
    <div class="contatos-secao">
      <div><i class="bi bi-telephone"></i><span>+55 31 99601-3814</span></div>
      <div><i class="bi bi-instagram"></i><span>@eetan.cf</span></div>
      <div><i class="bi bi-facebook"></i><span>eetan.almeidaneves</span></div>
    </div>
  </section>

  <footer class="footer-content">
    <div class="footer-social">
      <a
        href="https://www.facebook.com/eetan.almeidaneves?locale=pt_BR"
        target="_blank"><i
          style="padding-right: 10px; font-size: 20px; color: aliceblue"
          class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com/eetan.cf/" target="_blank"><i
          style="padding-right: 10px; font-size: 20px; color: aliceblue"
          class="bi bi-instagram"></i></a>
      <a
        href="https://www.google.com/maps/place/Escola+Estadual+Tancredo+de+Almeida+Neves/@-19.5003278,-42.637431,17z/data=!3m1!4b1!4m6!3m5!1s0xa5567c07a60a61:0x83e30fe60a08e640!8m2!3d-19.5003329!4d-42.6348561!16s%2Fg%2F11ggbds1s0?entry=ttu"
        target="_blank"
        title="Localização"><i
          style="padding-right: 10px; font-size: 20px; color: aliceblue"
          class="bi bi-geo-alt-fill"></i></a>
    </div>
    <div class="footer-info">
      <p style="color: aliceblue; margin: 0">
        &copy; 2024 ETAN - Escola Estadual Tancredo de Almeida Neves
      </p>
      <p style="margin: 0">
        <a
          target="_blank"
          style="color: aliceblue"
          href="https://api.whatsapp.com/send/?phone=31996013814&text&type=phone_number&app_absent=0"><i class="bi bi-whatsapp"></i> Contato</a>
        |
        <a style="color: aliceblue" href="../html/politica.php">
          <i class="bi bi-shield-lock"></i> Política de Privacidade
        </a>
      </p>
    </div>
  </footer>

  <script>
    let slideIndex = 0;
    const slideDuration = 10000; // 10 seconds

    function showSlides() {
      let slides = document.getElementsByClassName("slides");
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {
        slideIndex = 1;
      }
      slides[slideIndex - 1].style.display = "block";
      updateProgressBar();
      setTimeout(showSlides, slideDuration);
    }

    function updateProgressBar() {
      const progressBar = document.querySelector(".progress-bar");
      progressBar.style.width = "0%";
      setTimeout(() => {
        progressBar.style.transition = `width ${slideDuration}ms linear`;
        progressBar.style.width = "100%";
      }, 10);
    }

    showSlides(); // Start the slideshow
  </script>
</body>

</html>