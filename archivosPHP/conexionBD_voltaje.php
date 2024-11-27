<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db_name = "visioncontrol";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $db_name, $port);

if($conn->connect_error)
{
    die("Conexion fallida". $conn->connect_error);
}

if(isset ($_GET['voltaje']) + isset($_GET['IDElectrodo']) && $_GET['IDActuador'])
{
    $value = $_GET['voltaje'];
    $electrodo_ID = $_GET['IDElectrodo'];
    $IDActuador = $_GET['IDActuador'];

    date_default_timezone_set('America/Mexico_City');
    $datetime = new DateTime();
    
    $fecha_actual = $datetime->format("Y-m-d");
    $hora_actual = $datetime->format("H:i:s");

    $sql = "INSERT INTO voltaje (electrodoID, fecha, hora, voltajeMedido, IDActuador)
    VALUES ('$electrodo_ID','$fecha_actual','$hora_actual','$value', '$IDActuador')";

    if($conn->query($sql) === TRUE)
    {
        echo "Datos insertados correctamente" . "<br>";
    }
    else
    {
        "Error: " . $sql . "<br>" . $conn->error;
    }
}
else
{
    echo "Faltaron datos en la solicitud" . "<br>";
}
?>