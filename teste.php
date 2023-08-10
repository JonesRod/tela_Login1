<?php

//$msg= false;
//sleep(2);


sleep(5);
$msg = "Nova senha definida com sucesso.";
//sleep(2);

sleep(2);                   
$msg = "Você será redirecionado para a tele de login.";

//header("../login.php");
sleep(2); 
//$msg = "";                
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

    <span>
        <?php 
            echo $msg; 
        ?>
    </span>

</body>
</html>