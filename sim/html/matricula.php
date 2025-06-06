<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/stylelayout.css" />
  <link rel="stylesheet" href="../css/stylematricula.css" />
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <title>Formulário de Matrícula - EETAN</title>
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
    <form
      action="../php/matricula.php"
      method="post"
      enctype="multipart/form-data">
      <h1>Formulário de Matrícula</h1>
      <label for="nome">Nome Completo:</label>
      <input type="text" id="nome" name="nome" required />
      <label for="data_nascimento">Data de Nascimento:</label>
      <input
        type="date"
        id="data_nascimento"
        name="data_nascimento"
        required />
      <label for="sexo">Sexo:</label>
      <select id="sexo" name="sexo" required>
        <option value="" disabled selected>Selecione</option>
        <option value="feminino">Feminino</option>
        <option value="masculino">Masculino</option>
        <option value="outro">Outro</option>
      </select>
      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" required />
      <label for="contato">Número de Contato:</label>
      <input
        type="tel"
        id="contato"
        name="contato"
        required
        placeholder="(XX) XXXXX-XXXX" />
      <label for="endereco">Endereço Completo:</label>
      <input
        type="text"
        id="endereco"
        name="endereco"
        required
        placeholder="Rua, número, bairro, cidade, UF, CEP" />
      <label for="responsavel">Nome do Responsável:</label>
      <input type="text" id="responsavel" name="responsavel" required />
      <label for="cpf">CPF:</label>
      <input
        type="text"
        id="cpf"
        name="cpf"
        required
        placeholder="XXX.XXX.XXX-XX"
        maxlength="14" />
      <label for="rg">RG:</label>
      <input type="text" id="rg" name="rg" required />
      <label for="escola_origem">Escola de Origem:</label>
      <input type="text" id="escola_origem" name="escola_origem" required />
      <label for="ano">Ano/Série:</label>
      <select id="ano" name="ano" required>
        <option value="" disabled selected>Selecione</option>
        <option value="1">1º Ano</option>
        <option value="2">2º Ano</option>
        <option value="3">3º Ano</option>
      </select>
      <label for="turno">Turno:</label>
      <select id="turno" name="turno" required>
        <option value="" disabled selected>Selecione</option>
        <option value="integral">Integral</option>
        <option value="noturno">Noturno</option>
      </select>
      <label for="curso">Curso Desejado:</label>
      <select id="curso" name="curso" required>
        <option value="" disabled selected>Selecione um curso</option>
        <option value="desenvolvimento">Desenvolvimento de Sistemas</option>
        <option value="logistica">Logística</option>
        <option value="eja">EJA</option>
      </select>
      <label for="necessidades">Possui necessidades especiais?</label>
      <input
        type="text"
        id="necessidades"
        name="necessidades"
        placeholder="Descreva se houver" />
      <label for="documentos">Anexar Documentos (RG, CPF, comprovante de residência, histórico
        escolar):</label>
      <input type="file" id="documentos" name="documentos[]" multiple />
      <label>
        <input type="checkbox" name="autorizacao_imagem" required />
        Autorizo o uso de imagem do aluno para fins institucionais.
      </label>
      <button type="submit">Enviar</button>
    </form>
  </main>
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