<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $db = "visioncontrol";
    $port = 3307;

    $conn = new mysqli($servername, $username, $password, $db, $port);
    if($conn->connect_error)
    {
        die("Error al conectar a la base de datos" . $conn->connect_error . "<br>");
    }
?>