<?php
include('../lib/php/conexao.php');

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}
if(isset($_SESSION['email'])){

    $email = $_SESSION['email'];
    $senha = password_hash($_SESSION['senha'], PASSWORD_DEFAULT);
    $mysqli->query("INSERT INTO senha (email, senha) VALUES('$email','$senha')");

}

$id = $_SESSION['usuario'];
$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();

/*$id = $_SESSION['usuario'];
$sql_usuario = "SELECT * FROM usuarios";
$sql_usuario = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();*/
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site</title>
</head>
<body>
    <img src="" alt="">
    <p>
        <a href="perfil.php">Meu Perfil</a><a>Bem Vindo, <?php echo $usuario['nome']; ?></a><br>
        <a href="logout.php">Sair</a>
    </p>

</body>
</html>