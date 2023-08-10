<?php

    $msg= false;
    $minimo = 8;
    $maximo = 16;

if (isset($_POST['email']) || isset($_POST['senhaAtual'])) 
{
    if(strlen($_POST['senhaAtual']) == 0 ) {
        $msg = "Preencha sua senha Atual."; 

    } else if(strlen($_POST['novaSenha']) == 0 ) {
        $msg = "Preencha o campo Nova Senha.";

    }else if(strlen($_POST['novaSenha']) < $minimo ) {
        $msg = "Nova senha deve ter no minimo 8 digito.";
        
    }else if(strlen($_POST['novaSenha']) > $maximo ) {
        $msg = "Nona senha deve ter no maximo 16 digito.";

    }else if(strlen($_POST['confSenha']) == 0 ) {
        $msg = "Preencha o campo confirmar Senha.";

    }else if(strlen($_POST['confSenha']) < $minimo) {
        $msg = "Campo Confirmar Senha deve ter no minimo 8 digito.";

    }else if(strlen($_POST['confSenha']) > $maximo) {
        $msg = "Campo Confirmar Senha deve ter no maximo 16 digito.";

    }else
    {

        include("../lib/PHP/conexao.php");
        include("../lib/PHP/protect.php");
        include('../lib/php/enviarEmail.php');

        $email = $mysqli->escape_string($_POST['email']);//$mysqli->escape_string SERVE PARA PROTEGER O ACESSO 
        $senha = $mysqli->escape_string($_POST['senhaAtual']);
        $novaSenha = $_POST['novaSenha'];

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
        $sql_query =$mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
        $usuario = $sql_query->fetch_assoc();
        $quantidade = $sql_query->num_rows;//retorna a quantidade encontrado

        if(($quantidade ) == 1) 
        {

            if(password_verify($senha, $usuario['senha'])) 
            {

                $_SESSION['usuario'] = $usuario['id'];
                $nome = $usuario['nome'];
                //$_SESSION['admin'] = $usuario['admin'];

                $nova_senha_criptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

                $sql_code = "UPDATE usuarios
                SET senha = '$nova_senha_criptografada'
                WHERE email = '$email'";

                $editado = $mysqli->query($sql_code) or die($mysqli->error);

                if($editado) 
                {   
                    $msg = "Nova senha definida com sucesso. Você será redirecionado para a tele de login.";
                    
                    enviar_email($email, "Sua nova senha de acesso da plataforma", "
                    <h1>Seja bem vindo " . $nome . "</h1>
                    <p><b>Seu E-mail de acesso é: </b> $email</p>
                    <p><b>Sua senha de acesso é: </b> $novaSenha</p>
                    <p><b>Para redefinir sua senha </b><a href='../php/redefinir_senha.php'>clique aqui.</a></p>
                    <p><b>Para entrar </b><a href='login.php'>clique aqui.</a></p>");
                    
                    unset($_POST);

                    header("refresh: 5;logout.php");

                }
                    
            }else
            {
            $msg = "Senha inválida";
            }
        }else
        {
            $msg = "O e-mail informado não esta correto ou não está cadastrado!";
        }
    }      
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>redefinição de senha</title>
</head>
<body>
    <h2>Redefina sua nova Senha</h2>
    <form action="" method="POST">
        <span>
            <?php 
                echo $msg; 
            ?>
        </span>
        <p>
            <label for="">E-mail: </label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required type="text" name="email">
        </p>
        <p>
            <label for="">Senha Atual: </label>
            <input  type="password" name="senhaAtual" value="<?php if(isset($_POST['senhaAtual'])) echo $_POST['senhaAtual']; ?>">
        </p>
        <p>
            <label for="">Nova Senha: </label>
            <input placeholder="Minimo 8 digitos" type="password" name="novaSenha" value="<?php if(isset($_POST['novaSenha'])) echo $_POST['novaSenha']; ?>">
        </p>
        <p>
            <label for="">Confirmar Senha: </label>
            <input placeholder="Minimo 8 digitos" type="password" name="confSenha" value="<?php if(isset($_POST['confSenha'])) echo $_POST['confSenha']; ?>">
        </p>
        <a href="logout.php">Ir para login</a>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>