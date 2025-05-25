<?php
session_start();
include '../db/connection.php'; // Corrected the path to the connection file

$tipo_usuario = $_POST['tipo_usuario'];
if ($tipo_usuario == 'aluno') {
    $usuario = $_POST['aluno_usuario'];
    $senha = $_POST['aluno_senha'];
    $codigo = $_POST['aluno_codigo'];
} elseif ($tipo_usuario == 'professor') {
    $usuario = $_POST['professor_usuario'];
    $senha = $_POST['professor_senha'];
    $masp = $_POST['professor_codigo'];
} else {
    die("Tipo de usuário inválido.");
}

// Verificar credenciais no banco de dados
if ($tipo_usuario === 'aluno') {
    $query = "SELECT * FROM alunos WHERE usuario = :usuario AND senha = :senha";
    $stmt = $conn->prepare($query);
    $stmt->execute([':usuario  ' => $usuario, ':senha' => $senha]);
} elseif ($tipo_usuario === 'professor') {
    $query = "SELECT * FROM professores WHERE usuario = :usuario AND senha = :senha AND masp = :masp";
    $stmt = $conn->prepare($query);
    $stmt->execute([':usuario' => $usuario, ':senha' => $senha, ':masp' => $masp]);
} else {
    die("Tipo de usuário inválido.");
}

$result = $stmt->fetch();

if ($result) {
    $_SESSION['usuario'] = $result['usuario'];
    $_SESSION['tipo_usuario'] = $tipo_usuario;

    if ($tipo_usuario === 'professor') {
        header("Location: ../html/admin.php"); // Redireciona para a área administrativa
    } else {
        header("Location: ../html/index.php"); // Redireciona para a página inicial
    }
} else {
    echo "<script>alert('Usuário, senha ou MASP inválidos!'); window.location.href = '../html/cadastro.php';</script>";
}
