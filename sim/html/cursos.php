<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta
    name="description"
    content="Conheça os cursos oferecidos pela ETAN, incluindo Logística e Desenvolvimento de Sistemas." />
  <meta
    name="keywords"
    content="ETAN, cursos, Logística, Desenvolvimento de Sistemas, educação" />
  <title>Cursos - ETAN</title>
  <link rel="stylesheet" href="../css/stylescursos.css" />
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
    defer></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      AOS.init();
    });
  </script>
  <style>
    body {
      font-size: 1.2rem;
    }

    .more-text {
      display: none;
      font-size: inherit;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }

    .more-text.show {
      display: inline;
      opacity: 1;
    }

    .courses-container {
      display: flex;
      /* Alinha os cartões na mesma linha */
      gap: 30px;
      /* Espaçamento entre os cartões */
      justify-content: center;
      /* Centraliza os cartões horizontalmente */
      align-items: stretch;
      /* Garante que os cartões tenham a mesma altura */
      padding: 30px;
    }

    .course-card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
      width: 300px;
      /* Define uma largura fixa para os cartões */
      height: 100%;
      /* Garante que os cartões tenham a mesma altura */
      display: flex;
      flex-direction: column;
      /* Garante que o conteúdo interno seja organizado verticalmente */
    }

    .course-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .course-header {
      background-color: #213967;
      color: #fff;
      padding: 20px;
      font-size: 1.8rem;
      text-align: center;
    }

    .course-content {
      padding: 20px;
      font-size: 1.2rem;
      color: #333;
      text-align: center;
      flex-grow: 1;
      /* Faz o conteúdo ocupar o espaço restante */
    }

    .course-content img {
      display: block;
      width: 100%;
      /* Garante que as imagens ocupem 100% da largura do container */
      max-width: 300px;
      /* Define um tamanho máximo consistente */
      height: 200px;
      /* Define uma altura fixa para todas as imagens */
      object-fit: cover;
      /* Garante que as imagens sejam cortadas proporcionalmente */
      margin: 0 auto 15px auto;
      /* Centraliza as imagens */
      border-radius: 8px;
    }

    .course-footer {
      text-align: center;
      padding: 15px;
    }

    .course-footer button {
      background-color: #213967;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 12px 25px;
      font-size: 1.2rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .course-footer button:hover {
      background-color: #1a2d5b;
    }

    h2 {
      font-size: 2.4rem;
      margin-top: -10px;
      /* Reduz a margem superior para aproximar o título do topo */
      margin-bottom: 20px;
      text-align: center;
    }

    details summary {
      font-size: 1.3rem;
    }

    details p {
      font-size: 1.2rem;
    }

    .faq-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    .faq-container h2 {
      font-size: 2.6rem;
      /* Aumenta o tamanho do título do FAQ */
      text-align: center;
      margin-bottom: 20px;
      color: #213967;
    }

    .faq-item {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 15px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease;
    }

    .faq-item:hover {
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .faq-item summary {
      font-size: 1.5rem;
      /* Aumenta o tamanho do texto do resumo */
      font-weight: bold;
      padding: 15px 20px;
      cursor: pointer;
      background-color: #213967;
      color: #fff;
      border-bottom: 1px solid #ddd;
    }

    .faq-item[open] summary {
      background-color: #1a2d5b;
    }

    .faq-item p {
      font-size: 1.3rem;
      /* Aumenta o tamanho do texto das respostas */
      padding: 15px 20px;
      margin: 0;
      background-color: #fff;
      color: #333;
    }

    .footer-content {
      background-color: #213967;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    .footer-social {
      margin-bottom: 10px;
    }

    .footer-bibi {
      list-style: none;
      padding: 0;
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .footer-bibi li {
      display: inline;
    }

    .footer-bibi a {
      color: #fff;
      font-size: 1.5rem;
      transition: color 0.3s;
    }

    .footer-bibi a:hover {
      color: #1a2d5b;
    }

    .footer-info {
      font-size: 1rem;
    }

    .footer-info a {
      color: #fff;
      transition: color 0.3s;
    }

    .footer-info a:hover {
      color: #1a2d5b;
    }
  </style>
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

  <main>
    <section>
      <h2 data-aos="fade-up" style="text-align: center; margin-bottom: 20px">
        Cursos Oferecidos
      </h2>
      <div class="courses-container">
        <div class="course-card" data-aos="fade-right">
          <div class="course-header">Logística</div>
          <div class="course-content" id="logistica-content">
            <p>
              O curso de Logística da ETAN prepara os alunos para gerenciar e
              otimizar processos logísticos, desde a aquisição de
              matérias-primas até a entrega do produto final ao consumidor.
            </p>
            <img
              src="../fts/logisticafinal.jpg"
              alt="Imagem do curso de Logística" />
            <span class="more-text" id="logistica-more">
              <p>
                Os alunos aprendem sobre cadeia de suprimentos, gestão de
                estoques, transporte e distribuição, com uma abordagem prática
                e teórica.
              </p>
            </span>
          </div>
          <div class="course-footer">
            <button onclick="toggleMoreText('logistica-more', this)">
              Saiba Mais
            </button>
          </div>
        </div>

        <div class="course-card" data-aos="fade-left">
          <div class="course-header">Desenvolvimento de Sistemas</div>
          <div class="course-content" id="desenvolvimento-content">
            <p>
              O curso de Desenvolvimento de Sistemas da ETAN capacita os
              alunos para desenvolver, implementar e manter sistemas de
              software.
            </p>
            <img
              src="../fts/programacaofinal.jpg"
              alt="Imagem do curso de Desenvolvimento de Sistemas" />
            <span class="more-text" id="desenvolvimento-more">
              <p>
                Os alunos aprendem linguagens de programação, banco de dados,
                engenharia de software e metodologias ágeis, preparando-os
                para atuar em diversas áreas da tecnologia da informação.
              </p>
            </span>
          </div>
          <div class="course-footer">
            <button onclick="toggleMoreText('desenvolvimento-more', this)">
              Saiba Mais
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="faq-container">
      <h2 data-aos="fade-up">Perguntas Frequentes (FAQ)</h2>
      <details class="faq-item" data-aos="fade-up">
        <summary>Quais são os pré-requisitos para os cursos?</summary>
        <p>
          Os cursos são voltados para alunos do ensino médio e não exigem
          conhecimentos prévios.
        </p>
      </details>
      <details class="faq-item" data-aos="fade-up">
        <summary>Os cursos são gratuitos?</summary>
        <p>Sim, todos os cursos oferecidos pela ETAN são gratuitos.</p>
      </details>
      <details class="faq-item" data-aos="fade-up">
        <summary>Como faço para me inscrever?</summary>
        <p>
          Você pode se inscrever acessando a página de
          <a href="../html/matricula.php">Matrícula</a>.
        </p>
      </details>
    </section>
  </main>

  <script>
    function toggleMoreText(spanId, button) {
      const moreText = document.getElementById(spanId);
      if (moreText.classList.contains("show")) {
        moreText.classList.remove("show");
        setTimeout(() => {
          moreText.style.display = "none";
        }, 300); // Aguarda a animação terminar antes de ocultar
        button.textContent = "Saiba Mais";
      } else {
        moreText.style.display = "inline";
        setTimeout(() => {
          moreText.classList.add("show");
        }, 10); // Garante que a transição seja aplicada
        button.textContent = "Mostrar Menos";
      }
    }
  </script>

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
</body>

</html>