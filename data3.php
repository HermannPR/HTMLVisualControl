<?php
include 'conexion.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set("America/Mexico_City");
$datetime = new DateTime();
$dia = $datetime->format("d");

if(isset($_SESSION['pID'])) {
    $pID = $_SESSION['pID'];
    $electrodoID = [];
    $sql2 = $conn->prepare("SELECT IDelectrodo FROM electrodos WHERE pID = ?");
    $sql2->bind_param("i", $pID );

    if($sql2->execute()) {
        $result = $sql2->get_result();
        while($row2 = $result->fetch_assoc()) {
            $electrodoID[] = $row2['IDelectrodo'];
        }
    }
    $sql2->close();

    $data = [];
    foreach ($electrodoID as $ID) {
        $sql = $conn->prepare("SELECT IDActuador, count(*) AS cantidad FROM voltaje WHERE electrodoID = ? AND DAY(fecha) = ? GROUP BY IDActuador");
        $sql->bind_param("ii", $ID, $dia);
        if($sql->execute()) {
            $result = $sql->get_result();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $sql->close();
    }

    // Almacenar los datos en una variable de sesión
    $_SESSION['data3'] = $data;
} else {
    echo "No se ha iniciado sesión o no se ha seleccionado un paciente.";
}

$conn->close();
?>