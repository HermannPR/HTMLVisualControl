<?php
include 'conexion.php';
session_start();
header('Content-Type: application/json');

if(isset($_SESSION['IDDoctor'])) {
    $IDDoctor = $_SESSION['IDDoctor'];
    $pID = [];
    date_default_timezone_set("America/Mexico_City");
    $datetime = new DateTime();
    $dia = $datetime->format("d");
    $sql2 = $conn->prepare("SELECT pID FROM paciente WHERE IDDoctor = ?");
    $sql2->bind_param("i", $IDDoctor);
    $sql2->execute();
    $result2 = $sql2->get_result();
    while ($row2 = $result2->fetch_assoc()) {
        $pID[] = $row2['pID'];
    }
    $sql2->close();

    $response = [];
    foreach ($pID as $id) {
        $sql = $conn->prepare("SELECT HOUR(hora) AS HORA, voltajeMedido FROM voltaje WHERE electrodoID = ? AND DAY(fecha) = ?");
        $sql->bind_param("ii", $id, $dia);
        if ($sql->execute()) {
            $result = $sql->get_result();
            $horasVoltajes = [];
            $voltajes = [];
            while ($row = $result->fetch_assoc()) {
                $horasVoltajes[] = $row['HORA'];
                $voltajes[] = $row['voltajeMedido'];
            }
            $response[$id] = ['horas' => $horasVoltajes, 'voltajes' => $voltajes];
        } else {
            echo json_encode(['error' => 'Error en ejecucion']);
            exit();
        }
        $sql->close();
    }
    $conn->close();
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'No has iniciado sesión']);
}
?>