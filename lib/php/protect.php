<?php

if(!isset($_SESSION['id'])) {
    session_start();
} else {
    session_destroy();
    echo $_SESSION['id'];
    header("Location: login.php");
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"login.php\">Entrar</a></p>");
}

?>
