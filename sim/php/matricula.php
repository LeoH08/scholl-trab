<?php
/*-----------------------------------------------------------
 | 1. CONEXÃO (PDO)
 *----------------------------------------------------------*/
$host     = 'localhost';
$dbname   = 'escola_eetan'; // Verifique se o nome do banco está correto
$user     = 'root';       // Substitua 'Leozoa' pelo nome de usuário correto
$password = '';           // Substitua '00000000' pela senha correta (ou deixe vazio se não houver senha)
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // lança Exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,                  // use prepared nativo
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

/*-----------------------------------------------------------
 | 2. RECEBE E VALIDA CAMPOS DO FORMULÁRIO
 *----------------------------------------------------------*/
$required = [
    'nome',
    'data_nascimento',
    'sexo',
    'email',
    'contato',
    'endereco',
    'responsavel',
    'cpf',
    'rg',
    'escola_origem',
    'ano',
    'turno',
    'curso',
    'autorizacao_imagem'
];

# Função para validar campos obrigatórios
function validarCamposObrigatorios($campos, $dados)
{
    foreach ($campos as $campo) { // Corrigido "como" para "as"
        if (empty($dados[$campo])) {
            echo "<script>alert('O campo \"$campo\" é obrigatório. Por favor, preencha todos os campos.'); history.back();</script>";
            exit;
        }
    }
}

# Validar campos obrigatórios
validarCamposObrigatorios($required, $_POST);

# Sanitizar entradas
$nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$contato = filter_var($_POST['contato'], FILTER_SANITIZE_STRING);
// ...sanitize outros campos...

# Remova máscara do CPF
$cpf = preg_replace('/\D/', '', $_POST['cpf']); // "12345678909"

# Validação de CPF
function validarCPF($cpf)
{
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

if (!validarCPF($cpf)) {
    echo "<script>alert('CPF inválido. Por favor, verifique e tente novamente.'); history.back();</script>";
    exit;
}

# Remova máscara do RG
$rg = preg_replace('/\D/', '', $_POST['rg']); // Remove caracteres não numéricos

# Validação de RG
function validarRG($rg)
{
    return strlen($rg) >= 7 && strlen($rg) <= 14; // Exemplo: RG deve ter entre 7 e 14 dígitos
}

if (!validarRG($rg)) {
    echo "<script>alert('RG inválido. Por favor, verifique e tente novamente.'); history.back();</script>";
    exit;
}

# Validação de e-mail
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('E-mail inválido. Por favor, verifique e tente novamente.'); history.back();</script>";
    exit;
}

/*-----------------------------------------------------------
 | 3. FAZ UPLOAD DOS DOCUMENTOS
 *----------------------------------------------------------*/
$paths = []; // guardará os caminhos para inserir no DB
$uploadDir = __DIR__ . '/uploads/'; // certifique‑se de que exista (chmod 755)

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

# Melhorar segurança no upload de arquivos
if (!empty($_FILES['documentos']['name'][0])) {
    foreach ($_FILES['documentos']['tmp_name'] as $key => $tmpName) {
        $mimeType = mime_content_type($tmpName);
        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        if (!in_array($mimeType, $allowedTypes)) {
            echo "<script>alert('Tipo de arquivo inválido. Apenas PDF, JPEG e PNG são permitidos.'); history.back();</script>";
            exit;
        }
        $origName  = basename($_FILES['documentos']['name'][$key]);
        $ext       = pathinfo($origName, PATHINFO_EXTENSION);
        $newName   = uniqid('doc_') . '.' . $ext;
        $destPath  = $uploadDir . $newName;

        if (move_uploaded_file($tmpName, $destPath)) {
            $paths[] = 'uploads/' . $newName; // caminho relativo
        }
    }
}
$docPaths = implode(';', $paths); // separa por “;”

/*-----------------------------------------------------------
 | 4. INSERT PREPARADO
 *----------------------------------------------------------*/
try {
    // Verifica o maior ID atual na tabela
    $stmtMaxId = $pdo->query("SELECT MAX(id) AS max_id FROM matriculas");
    $result = $stmtMaxId->fetch();
    $nextId = ($result['max_id'] ?? 0) + 1;

    // Ajusta o AUTO_INCREMENT para o próximo ID correto
    $pdo->exec("ALTER TABLE matriculas AUTO_INCREMENT = $nextId");
} catch (PDOException $e) {
    die("Erro ao ajustar AUTO_INCREMENT: " . $e->getMessage());
}

# Verifica duplicidade de CPF ou e-mail
try {
    $stmtCheckDuplicate = $pdo->prepare("SELECT COUNT(*) AS total FROM matriculas WHERE cpf = :cpf OR email = :email");
    $stmtCheckDuplicate->execute([':cpf' => $cpf, ':email' => $_POST['email']]);
    $result = $stmtCheckDuplicate->fetch();

    if ($result['total'] > 0) {
        echo "<script>alert('Já existe uma matrícula com este CPF ou e-mail. Por favor, verifique as informações e tente novamente.'); history.back();</script>";
        exit;
    }
} catch (PDOException $e) {
    echo "<script>alert('Erro ao verificar duplicidade: " . $e->getMessage() . "'); history.back();</script>";
    exit;
}

// Preenche "necessidades" com "Não" se estiver em branco
$necessidades = !empty($_POST['necessidades']) ? $_POST['necessidades'] : 'Não';

$sql = "INSERT INTO matriculas
        (nome,data_nascimento,sexo,email,contato,endereco,responsavel,cpf,rg,
         escola_origem,ano,turno,curso,necessidades,doc_paths,autorizacao_img)
        VALUES
        (:nome,:data_nascimento,:sexo,:email,:contato,:endereco,:responsavel,:cpf,:rg,
         :escola_origem,:ano,:turno,:curso,:necessidades,:doc_paths,:autorizacao_img)";

$stmt = $pdo->prepare($sql);

$params = [
    ':nome'              => $_POST['nome'],
    ':data_nascimento'   => $_POST['data_nascimento'],
    ':sexo'              => $_POST['sexo'],
    ':email'             => $_POST['email'],
    ':contato'           => $_POST['contato'],
    ':endereco'          => $_POST['endereco'],
    ':responsavel'       => $_POST['responsavel'],
    ':cpf'               => $cpf,
    ':rg'                => $rg, // Atualizado para usar o RG formatado
    ':escola_origem'     => $_POST['escola_origem'],
    ':ano'               => (int)$_POST['ano'],
    ':turno'             => $_POST['turno'],
    ':curso'             => $_POST['curso'],
    ':necessidades'      => $necessidades, // Atualizado para usar o valor padrão
    ':doc_paths'         => $docPaths ?: null,
    ':autorizacao_img'   => isset($_POST['autorizacao_imagem']) ? 1 : 0,
];

try {
    $stmt->execute($params);
} catch (PDOException $e) {
    echo "Erro ao inserir: " . $e->getMessage();
}

// Salvar os dados em um arquivo .txt de forma organizada (sem tabela)
$txtFile = "../txt/matriculas.txt";

// Certifique-se de que as variáveis estão definidas
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$contato = $_POST['contato'];
$endereco = $_POST['endereco'];
$responsavel = $_POST['responsavel'];
$rg = $_POST['rg'];
$escola_origem = $_POST['escola_origem'];
$ano = $_POST['ano'];
$turno = $_POST['turno'];
$curso = $_POST['curso'];
$necessidades = !empty($_POST['necessidades']) ? $_POST['necessidades'] : 'Não';
$autorizacao_imagem = isset($_POST['autorizacao_imagem']) ? 'Sim' : 'Não';

$linhaTxt =
    "Nome: $nome\n" .
    "Data de Nascimento: $data_nascimento\n" .
    "Sexo: $sexo\n" .
    "Email: $email\n" .
    "Contato: $contato\n" .
    "Endereço: $endereco\n" .
    "Responsável: $responsavel\n" .
    "CPF: $cpf\n" .
    "RG: $rg\n" . // Atualizado para incluir o RG formatado
    "Escola de Origem: $escola_origem\n" .
    "Ano: $ano\n" .
    "Turno: $turno\n" .
    "Curso: $curso\n" .
    "Necessidades: $necessidades\n" . // Atualizado para incluir o valor padrão
    "Autorização de Imagem: $autorizacao_imagem\n" .
    "-----------------------------\n";

if (!is_dir(dirname($txtFile))) {
    mkdir(dirname($txtFile), 0755, true);
}

file_put_contents($txtFile, $linhaTxt, FILE_APPEND);

function incluirCabecalho()
{
    include '../html/cabecalho.html';
}

function incluirRodape()
{
    include '../html/rodape.html';
}

echo '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Matrícula enviada - EETAN</title>
        <link rel="stylesheet" href="../css/stylematricula2.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        <link rel="shortcut icon" href="../fts/Logo_EETAN.png" type="image/x-icon" />
    </head>
    <body>
        <header class="content">
            <div class="logo">
                <a href="../html/index.html"><img src="../fts/Logo_EETAN.png" alt="logo_escola"></a>
                <h3><a href="index.html" style="color: aliceblue;">EETAN</a></h3>
            </div>
            <nav>
                <ul class="list-menu">
                    <li><a href="../html/sobre.html">Sobre</a></li>
                    <li><a href="../html/cursos.html">Cursos</a></li>
                    <li><a href="../html/direcao.html">Direção</a></li>
                    <li><a href="../html/CorpoDocente.html">Professores</a></li>
                    <li><a href="../html/matricula.html">Matricula</a></li>
                    <li>
                        <a href="../html/cadastro.html">
                            <i class="bi bi-person-circle"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/eetan.almeidaneves?locale=pt_BR" target="_blank">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/eetan.cf/" target="_blank">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.google.com/maps/place/Escola+Estadual+Tancredo+de+Almeida+Neves/@-19.5003278,-42.637431,17z/data=!3m1!4b1!4m6!3m5!1s0xa5567c07a60a61:0x83e30fe60a08e640!8m2!3d-19.5003329!4d-42.6348561!16s%2Fg%2F11ggbds1s0?entry=ttu" target="_blank">
                            <i class="bi bi-geo-alt-fill"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="confirmacao-matricula">
                <h1>Matrícula enviada com sucesso!</h1>
                <p>
                    Suas informações foram recebidas.<br>
                    Aguarde um e-mail de confirmação nos próximos <strong>7 dias</strong>.<br>
                    Caso não receba, entre em contato com a secretaria da escola.
                </p>
                <a class="btn-voltar" href="../html/index.html">Voltar para o início</a>
            </div>
        </main>
        <footer>
            <p>&copy; 2024 ETAN - Escola Tancredo de Almeida Neves</p>
        </footer>
    </body>
    </html>
    ';
