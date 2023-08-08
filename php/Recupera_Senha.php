<?php

$msg = false;


if(isset($_POST['email'])) {

    include('../lib/php/conexao.php');
    include('../lib/php/generateRandomString.php');
    include('../lib/php/enviarEmail.php');

    if(strlen($_POST['email']) == 0 ) {
        $msg = "Preencha ocampo E-mail.";
        echo $msg;
    } else {

        $email = $mysqli->escape_string($_POST['email']);
        $sql_query = $mysqli->query("SELECT id, nome FROM usuarios WHERE email = '$email'");
        $result = $sql_query->fetch_assoc();
        $registro = $sql_query->num_rows;

 //       var_dump($_POST);
        if(($registro ) == 1) {
            if($result['id']) {

            $nova_senha = generateRandomString(8);
            $nova_senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);
            $id_usuario = $result['id'];
            $mysqli->query("UPDATE usuarios SET senha = '$nova_senha_criptografada' WHERE id = '$id_usuario'");
            enviar_email($email, "Sua nova senha do seu site", "
            <h1>Olá " . $result['nome'] . "</h1>
            <p>Uma nova senha foi definida para a sua conta.</p>
            <p><b>Nova senha: </b> $nova_senha</p>
            <p><b>Para redefinir sua senha </b><a href='redefinir_senha.php'>clique aqui.</a></p>
            <p><b>Para entrar </b><a href='../login.php'>clique aqui.</a></p>");
            
            $msg = "Você será redirecionado para a pagina de Login.";
            echo $msg;
            header("refresh: 5; ../login.php");
            }    
        }
        if(($registro ) == 0) {
            $msg = "Não existe nenhum Usuario cadastrado com esse e-mail!";
            echo $msg;
            header("refresh: 5; ../login.php");
        }
    }  
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
</head>
<body>
    <h1>Recupere sua Senha.</h1>
    <form action="" method="POST">
        <p>  
            <label for="">Digite E-mail cadastrado</label>
            <input type="email" name="email">
        </p>
        <a style="margin-right:40px;" href="login.php">< Voltar</a> 
        <button type="submit">Enviar</button>
    </form>
</body>
</html>