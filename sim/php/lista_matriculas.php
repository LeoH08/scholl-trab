<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=escola_eetan;charset=utf8mb4',
  'adm',
  '',
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// Process search and order inputs
$search = $_GET['search'] ?? '';
$orderBy = $_GET['order_by'] ?? 'id';
$orderDir = $_GET['order_dir'] ?? 'ASC';

$allowedColumns = ['id', 'nome', 'data_nascimento', 'sexo', 'email', 'contato', 'endereco', 'responsavel', 'cpf', 'rg', 'escola_origem', 'ano', 'turno', 'curso', 'necessidades', 'dt_cadastro'];
$orderBy = in_array($orderBy, $allowedColumns) ? $orderBy : 'id';
$orderDir = strtoupper($orderDir) === 'DESC' ? 'DESC' : 'ASC';

$stmt = $pdo->prepare("SELECT * FROM matriculas WHERE CONCAT_WS(' ', id, nome, data_nascimento, sexo, email, contato, endereco, responsavel, cpf, rg, escola_origem, ano, turno, curso, necessidades, dt_cadastro) LIKE :search ORDER BY $orderBy $orderDir");
$stmt->execute(['search' => "%$search%"]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['delete_id'])) {
    // Excluir matrícula
    $deleteId = (int)$_POST['delete_id'];
    $stmtDelete = $pdo->prepare("DELETE FROM matriculas WHERE id = :id");
    $stmtDelete->execute([':id' => $deleteId]);
    header("Location: lista_matriculas.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Matrículas ‑ EETAN</title>
  <style>
    /* Estilo para o formulário */
    form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
      align-items: center;
    }

    form label {
      font-weight: bold;
    }

    form input,
    form select,
    form button {
      padding: 6px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    form button {
      background-color: #002b5b;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    form button:hover {
      background-color: #004080;
    }

    /* Estilo para a tabela */
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
      font-size: 14px;
    }

    th {
      background-color: #002b5b;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f6ff;
    }

    tr:hover {
      background-color: #e6f0ff;
      transition: background-color 0.3s;
    }

    /* Estilo para o título */
    h1 {
      color: #002b5b;
      font-family: Arial, sans-serif;
      text-align: center;
      margin-bottom: 20px;
    }

    /* Botões de ação */
    .action-buttons {
      display: flex;
      gap: 5px;
    }

    .action-buttons button {
      padding: 5px 10px;
      font-size: 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .action-buttons .edit-btn {
      background-color: #ffc107;
      color: #fff;
    }

    .action-buttons .delete-btn {
      background-color: #dc3545;
      color: #fff;
    }

    .action-buttons button:hover {
      opacity: 0.8;
    }
  </style>
</head>

<body>
  <h1>Lista de Matrículas</h1>

  <form method="get" style="margin-bottom: 20px;">
    <label for="search">Pesquisar:</label>
    <input type="text" id="search" name="search" value="<?= htmlspecialchars($search) ?>">

    <label for="order_by">Ordenar por:</label>
    <select id="order_by" name="order_by">
      <?php foreach ($allowedColumns as $column): ?>
        <option value="<?= $column ?>" <?= $column === $orderBy ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', $column)) ?></option>
      <?php endforeach; ?>
    </select>

    <label for="order_dir">Ordem:</label>
    <select id="order_dir" name="order_dir">
      <option value="ASC" <?= $orderDir === 'ASC' ? 'selected' : '' ?>>Crescente</option>
      <option value="DESC" <?= $orderDir === 'DESC' ? 'selected' : '' ?>>Decrescente</option>
    </select>

    <button type="submit">Aplicar</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Data Nasc.</th>
        <th>Sexo</th>
        <th>Email</th>
        <th>Contato</th>
        <th>Endereço</th>
        <th>Responsável</th>
        <th>CPF</th>
        <th>RG</th>
        <th>Escola Origem</th>
        <th>Ano</th>
        <th>Turno</th>
        <th>Curso</th>
        <th>Necessidades</th>
        <th>Docs</th>
        <th>Aut. Imagem</th>
        <th>Cadastrado em</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?= $r['id'] ?></td>
          <td><?= htmlspecialchars($r['nome']) ?></td>
          <td><?= $r['data_nascimento'] ?></td>
          <td><?= $r['sexo'] ?></td>
          <td><?= htmlspecialchars($r['email']) ?></td>
          <td><?= htmlspecialchars($r['contato']) ?></td>
          <td><?= htmlspecialchars($r['endereco']) ?></td>
          <td><?= htmlspecialchars($r['responsavel']) ?></td>
          <td><?= $r['cpf'] ?></td>
          <td><?= htmlspecialchars($r['rg']) ?></td>
          <td><?= htmlspecialchars($r['escola_origem']) ?></td>
          <td><?= $r['ano'] ?></td>
          <td><?= $r['turno'] ?></td>
          <td><?= $r['curso'] ?></td>
          <td><?= htmlspecialchars($r['necessidades']) ?></td>
          <td>
            <?php
            $docs = array_filter(explode(';', $r['doc_paths']));
            foreach ($docs as $d) {
              echo "<a href=\"$d\" target=\"_blank\">arquivo</a><br>";
            }
            ?>
          </td>
          <td><?= $r['autorizacao_img'] ? 'Sim' : 'Não' ?></td>
          <td><?= $r['dt_cadastro'] ?></td>
          <td>
            <div class="action-buttons">
              <form action="editar_matricula.php" method="get" style="display:inline;">
                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                <button type="submit" class="edit-btn">Editar</button>
              </form>
              <form method="post" style="display:inline;">
                <input type="hidden" name="delete_id" value="<?= $r['id'] ?>">
                <button type="submit" class="delete-btn" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>