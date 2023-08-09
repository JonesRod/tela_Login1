<?php

if (isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0 ) {
        header("Location: ../css/login.css");
       echo "Preencha o campo E-mail.";

    } else if(strlen($_POST['senha']) == 0 ) {

       echo "Preencha sua senha.";
    } else {
        include("../lib/troca_de_informacoesPHP/conexao.php");
        include("../lib/troca_de_informacoesPHP/protect.php");

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
                    
                    header("Location: ../index.php");
            }else{
                echo "Senha inválida";
            }
        }else{
            echo "O e-mail informado não esta correto ou não está cadastrado!";
        }
    }   
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <p id="entrar">Entrar</p>
    <main class="conteiner">   
        <form action="php/logarindex.php" method="POST">
            <h1 id="titulo">Entrar</h1>
            <p>
                <label for="">E-mail</label>
                <input required type="text" name="email">
            </p>
            <p>
                <label for="">Senha</label>
                <input required type="password" name="senha">
            </p>
            <p>
                <a style="margin-right:40px;" href="cadastro_usuario.php">Quero me Cadastrar.</a> 
                <a style="margin-right:40px;" href="Recupera_Senha.php">Esqueci minha Senha!</a> 
            </p>
            <button type="submit">Entrar</button>
        </form>
    </main>
    <p>
        <a href="php/login.html">Entrar</a><br>
        <a href="php/logout.php">Sair</a>
    </p>
</body>
</html>