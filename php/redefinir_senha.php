<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>redefinição de senha</title>
</head>
<body>
    <h2>Redefina sua nova Senha</h2>
    <form action="" method="post">
        <p>
            <label for="">Senha Atual: </label>
            <input required type="password" name="senhaAtual">
        </p>
        <p>
            <label for="">Nova Senha: </label>
            <input required type="password" name="novaSenha">
        </p>
        <p>
            <label for="">Confirmar Senha: </label>
            <input required type="password" name="confSenha">
        </p>
        <button type="submit">Cancelar</button>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>