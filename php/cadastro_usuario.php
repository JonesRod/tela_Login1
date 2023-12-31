<?php

$msg = false;

if(isset($_POST['nome']) || isset($_POST['email'])) {

    include('../lib/php/conexao.php');
    include('../lib/php/generateRandomString.php');
    include('../lib/php/enviarEmail.php');

    if(strlen($_POST['nome']) == 0 ) {
        $msg = true;
        $msg = "Preencha o campo do Nome.";
        echo $msg;
    }else if(strlen($_POST['email']) == 0 ) {
        $msg = true;
        $msg = "Preencha ocampo E-mail.";
        echo $msg;
    } else {

        $email = $mysqli->escape_string($_POST['email']);
        $nome = $mysqli->escape_string($_POST['nome']);

        $sql_query = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'");
        $result = $sql_query->fetch_assoc();
        $registro = $sql_query->num_rows;

        if(($registro ) == 0) {

            $senha = $_POST['confSenha'];
            $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
            $sql_code = "INSERT INTO usuarios (nome, email, senha, data) 
            VALUES('$nome','$email','$senha_criptografada', NOW())";
            $deu_certo = $mysqli->query($sql_code) or die($mysqli->$error);

            if($deu_certo){

                $msg = "A confirmação de seu cadastrado será enviada para esse e-mail!";
                echo $msg;

                enviar_email($email, "Sua nova senha de acesso na plataforma", "
                <h1>Seja bem vindo " . $nome . "</h1>
                <p><b>Seu E-mail de acesso é: </b> $email</p>
                <p><b>Sua senha de acesso é: </b> $senha</p>
                <p><b>Para redefinir sua senha </b><a href='../php/redefinir_senha.php'>clique aqui.</a></p>
                <p><b>Para entrar </b><a href='index.php'>clique aqui.</a></p>");

                unset($_POST);

                header("refresh: 5;../login.php"); //Atualiza a pagina em 5s e redireciona apagina
            }
        }
        if(($registro ) != 0) {
            $msg = true;
            $msg = "Já existe um Usuario cadastrado com esse e-mail!";
            echo $msg;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuario</title>
</head>
<body>
    <form method="POST" action="">
        <h1>Cadastre-se</h1>
        <p>
            <label>Nome:</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text"><br>
        </p>
        <p>
            <label>E-mail:</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" type="email"><br>
        </p>
        <p>
            <label for="">Senha: </label>
            <input placeholder="Minimo 8 digitos" value="<?php if(isset($_POST['senha'])) echo $_POST['senha']; ?>" type="password" name="senha">
        </p>
        <p>
            <label for="">Confirmar Senha: </label>
            <input placeholder="Minimo 8 digitos" value="<?php if(isset($_POST['confSenha'])) echo $_POST['confSenha']; ?>" type="password" name="confSenha">
        </p>
        <p>
            <a href="../index.php">Voltar para tela de login</a>
            <button type="submit">Cadastrar</button>
        </p>
    </form>
</body>
</html> 
