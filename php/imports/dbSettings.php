<?php
    $dbDatabasename = 'getraenkeHandel2';
    $dbLoginUsername = 'root';
    $dbPassword = '';

    $conn = new PDO("mysql:host=localhost;dbname=".$dbDatabasename, $dbLoginUsername, $dbPassword);
    $conn->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $con = MySQLi_connect(
        'localhost',
        'root',
        '',
        'getraenkeHandel2'
    );
?>