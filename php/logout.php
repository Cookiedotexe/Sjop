<?php
    session_start();

    unset($_SESSION["id"]);
    unset($_SESSION["vorname"]);
    unset($_SESSION["nachname"]);
    unset($_SESSION["email"]);
    unset($_SESSION["lastLogin"]);

    session_destroy();
    session_unset();

    header("Location:../index.php");
?>