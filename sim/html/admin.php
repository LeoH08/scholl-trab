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
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/admin.css?<?php echo get_that_filetime('../css/admin.css'); ?>" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
    rel="stylesheet" />
  <title>EETAN | Admin</title>
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
  <main style="color: black; font-size: 20px;">
    <h1 style="color: black;">Bem-vindo à Área Administrativa</h1>
    <p style="color: black;">Use as ferramentas abaixo para gerenciar o site:</p>
    <ul>
      <li><a href="../php/lista_matriculas.php">Gerenciar Alunos</a></li>
      <li>
        <a href="../html/gerenciar_professores.php">Gerenciar Professores</a>
      </li>
    </ul>
  </main>
  <footer class="footer-content">
    <div class="footer-social">
      <ul class="list-menu footer-bibi">
        <li>
          <a
            href="https://www.facebook.com/eetan.almeidaneves?locale=pt_BR"
            target="_blank"
            title="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
        </li>
        <li>
          <a
            href="https://www.instagram.com/eetan.cf/"
            target="_blank"
            title="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
        </li>
        <li>
          <a
            href="https://www.google.com/maps/place/Escola+Estadual+Tancredo+de+Almeida+Neves/@-19.5003278,-42.637431,17z/data=!3m1!4b1!4m6!3m5!1s0xa5567c07a60a61:0x83e30fe60a08e640!8m2!3d-19.5003329!4d-42.6348561!16s%2Fg%2F11ggbds1s0?entry=ttu"
            target="_blank"
            title="Localização">
            <i class="bi bi-geo-alt-fill"></i>
          </a>
        </li>
      </ul>
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
</body>

</html>