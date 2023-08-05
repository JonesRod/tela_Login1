<?php
include('lib/php/conexao.php');

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['usuario'])){
    die("Entre como um usuario.  <a href=\"php/login.php\">Entrar</a>
    <a href=''></a>
    <a href=\"php/cadastro_usuario.php\">Me cadastrar</a>
    ");
}
if(isset($_SESSION['email'])){

    $email = $_SESSION['email'];
    $senha = password_hash($_SESSION['senha'], PASSWORD_DEFAULT);
    $mysqli->query("INSERT INTO senha (email, senha) VALUES('$email','$senha')");

}

$id = $_SESSION['usuario'];
$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <p>Bem Vindo, <?php echo $usuario['nome']; ?></p>
    <p>
        <a href="editar_dados_usuario.php">Editar dados do Usuario</a><br>
        <a href="logout.php">Sair</a>
    </p>
</body>
</html>