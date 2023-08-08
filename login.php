<?php

$msg= false;

if (isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0 ) {
        $msg= true;
        $msg = "Preencha o campo E-mail.";

    } else if(strlen($_POST['senha']) == 0 ) {
        $msg= true;
        $msg = "Preencha sua senha.";

    } else {
        include("lib/troca_de_informacoesPHP/conexao.php");
        include("lib/troca_de_informacoesPHP/protect.php");

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
        $sql_query =$mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
        $quantidade = $sql_query->num_rows;
        $usuario = $sql_query->fetch_assoc();

        if(($quantidade ) == 1) {
            if(password_verify($senha, $usuario['senha'])) {
                if(!isset($_SESSION))
                    session_start();

                    $_SESSION['usuario'] = $usuario['id'];
                    
                    header("Location: php/index.php");
            }else{
                $msg= true;
                $msg = "Senha inválida";
            }
        }else{
            $msg= true;
            $msg = "O e-mail informado não esta correto ou não está cadastrado!";
        }
    }   
}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/css/login.css">
    <title>Entrar</title>
</head>
<body>
    <main class="conteiner">   
        <form action="" method="POST">
            <h1 id="titulo">Entrar</h1>
            <span>
                <?php 
                    echo $msg; 
                ?>
            </span>
            <p>
                <label id="email" for="">E-mail</label>
                <input required type="text" name="email">
            </p>
            <p>
                <label id="senha" for="">Senha</label>
                <input required type="password" name="senha">
            </p>
            <p>
                <a style="margin-right:40px;" href="php/cadastro_usuario.php">Quero me Cadastrar.</a> 
                <a style="margin-right:40px;" href="php/Recupera_Senha.php">Esqueci minha Senha!</a> 
            </p>
            <button type="submit">Entrar</button>
        </form>
    </main>
</body>
</html>