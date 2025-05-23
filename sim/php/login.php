<?php
session_start();
include '../../db/connection.php'; // Corrected the path to the connection file

$tipo_usuario = $_POST['tipo_usuario'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$masp = isset($_POST['masp']) ? $_POST['masp'] : null;

// Verificar credenciais no banco de dados
if ($tipo_usuario === 'aluno') {
    $query = "SELECT * FROM alunos WHERE usuario = :usuario AND senha = :senha";
    $stmt = $conn->prepare($query);
    $stmt->execute([':usuario' => $usuario, ':senha' => $senha]);
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
        header("Location: ../html/admin.html"); // Redireciona para a área administrativa
    } else {
        header("Location: ../html/index.html"); // Redireciona para a página inicial
    }
} else {
    echo "<script>alert('Usuário, senha ou MASP inválidos!'); window.location.href = '../html/login.html';</script>";
}
