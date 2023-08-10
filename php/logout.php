<?php

if(!isset($_SESSION)) {
    session_start();
}

session_destroy();
//echo $_SESSION['id'];
header("Location: ../index.php");

?>