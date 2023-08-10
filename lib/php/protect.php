<?php

if(!isset($_SESSION['id'])) {
    session_start();
} else {
    session_destroy();
    echo $_SESSION['id'];
    header("Location: index.php");
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"index.php\">Entrar</a></p>");
}

?>
