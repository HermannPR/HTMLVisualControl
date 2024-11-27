<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "visioncontrol";
    $port = 3307;
    $socket = new mysqli($servername, $username, $password, $database, $port);
    if($socket->connect_error)
    {
        die("No se pudo conectar al servidor" . $socket->connect_error);
    }
    if(isset($_GET['IDActuador']) + isset($_GET['estado']))
    {
        $valor = $_GET['IDActuador'];
        $estado = $_GET['estado'];
        date_default_timezone_set('America/Mexico_City');

        $datetime = new datetime();

        $fecha_actual = $datetime->format('Y-m-d');
        $hora_actual = $datetime->format('H:i:s');

        $estadoS = ($estado == 1) ? "APAGADO" : "ENCENDIDO";

        $update = "UPDATE actuadores
                    SET fecha = '$fecha_actual',
                    hora = '$hora_actual',
                    estado = '$estadoS'
                    WHERE IDActuador = '$valor'";
        if($socket->query($update) === TRUE)
        {
            echo "datos insertados correctamente" . "<br>";
        }
    }
    else
    {
        echo "Faltaron datos en la solicitud" . "<br>";
    }
?>