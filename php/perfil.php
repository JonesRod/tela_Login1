<?php
    /*codigo da sessão
    include('../lib/php/conexao.php');

    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_SESSION['usuario'])){
        header("Location: ../login.php");
    }*/
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
</head>
<body>
    <form method="POST" action="">
        <div>
            <img src="" alt="">
            <a href="">Editar</a>
        </div>    
        <p>
            <label>Nome: </label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text"><br>
        </p>
        <p>
            <label>Sobrenome: </label>
            <input value="<?php if(isset($_POST['sobrenome'])) echo $_POST['sobrenome']; ?>" name="sobrenome" type="text"><br>
        </p>
        <p>
            <label>CPF: </label>
            <input value="<?php if(isset($_POST['cpf'])) echo $_POST['cpf']; ?>" name="cpf" type="text"><br>
        </p>
        <p>
            <label>RG: </label>
            <input value="<?php if(isset($_POST['rg'])) echo $_POST['rg']; ?>" name="rg" type="text"><br>
        </p>
        <p>
            <label>Data de Nascimento: </label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>" name="nascimento" type="text"><br>
        </p>
        <p>
            <label>Cidade Natal: </label>
            <input value="<?php if(isset($_POST['cidnatal'])) echo $_POST['cidnatal']; ?>" name="cidnatal" type="text"><br>
        </p>
        <p>
            <label>UF: </label>
            <input value="<?php if(isset($_POST['uf'])) echo $_POST['uf']; ?>" name="uf" type="text"><br>
        </p>
        <p>
            <label>Celular 1: </label>
            <input value="<?php if(isset($_POST['celular1'])) echo $_POST['celular1']; ?>" name="celular1" type="text"><br>
        </p>
        <p>
            <label>Celular 2: </label>
            <input value="<?php if(isset($_POST['celular2'])) echo $_POST['celular2']; ?>" name="celular2" type="text"><br>
        </p>
        <p>
            <label>Endereço: </label>
            <input value="<?php if(isset($_POST['endereco'])) echo $_POST['endereco']; ?>" name="endereco" type="text"><br>
        </p>
        <p>
            <label>N°: </label>
            <input value="<?php if(isset($_POST['numero'])) echo $_POST['numero']; ?>" name="numero" type="text"><br>
        </p>
        <p>
            <label>Bairro: </label>
            <input value="<?php if(isset($_POST['bairro'])) echo $_POST['bairro']; ?>" name="bairro" type="text"><br>
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
            <a href="">Voltar</a>
            <button type="submit">Salvar</button>
        </p>
</body>
</html>