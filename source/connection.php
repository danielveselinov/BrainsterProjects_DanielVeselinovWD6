<?php
    $mysql_hostname = "localhost";
    $mysql_username = "root";
    $mysql_password = "";
    $mysql_database = "brainsterlabs"; // insert database

    $SQL = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
    mysqli_set_charset($SQL, "UTF-8");
    mysqli_query($SQL, "SET NAMES 'utf8'");

    if (!$SQL)
    {
        header("Location: ../home");
        exit();
    }
?>