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

        include("lib/PHP/conexao.php");
        include("lib/PHP/protect.php");

        $email = $mysqli->escape_string($_POST['email']);//$mysqli->escape_string SERVE PARA PROTEGER O ACESSO 
        $senha = $mysqli->escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
        $sql_query =$mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->$error);
        $usuario = $sql_query->fetch_assoc();
        $quantidade = $sql_query->num_rows;//retorna a quantidade encontrado


        if(($quantidade ) == 1) {
            if(password_verify($senha, $usuario['senha'])) {
                if(!isset($_SESSION))
                    session_start();

                    $_SESSION['usuario'] = $usuario['id'];
                    //$_SESSION['admin'] = $usuario['admin'];
                    unset($_POST);
                    header("Location: php/home.php");
            }else{
                //$msg= true;
                $msg = "Usúario ou Senha estão inválidos!";
            }
        }else{
            //$msg= true;
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
    <link rel="stylesheet" href="lib/css/index.css">
    <title>Entrar</title>
</head>
<body>
    <main class="conteiner">   
        <form id ="login" action="" method="POST">
            <div id="img"></div>
            <h1 id="titulo">Entrar</h1>
            <span>
                <?php 
                    echo $msg; 
                ?>
            </span>
            <p>
                <label id="email" for="">E-mail</label>
                <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required type="text" name="email">
            </p>
            <p>
                <label id="senha" for="">Senha</label>
                <input required type="password" name="senha">
            </p>
            <p> 
                <a style="margin-right:10px;" href="php/cadastro_usuario.php">Quero me Cadastrar.</a> 
                <a style="margin-right:10px;" href="php/Recupera_Senha.php">Esqueci minha Senha!</a> 
            </p>
            <button type="submit">Entrar</button>
        </form>
    </main>
</body>
</html>