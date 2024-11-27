<?php
    include('conexion.php');
    $sql = $conn->prepare("SELECT HOUR(hora) AS HORA, voltajeMedido FROM voltaje");
    if($sql->execute())
    {
        $result = $sql->get_result();
        $horasVoltajes = [];
        $voltajes = [];
        while($row = $result->fetch_assoc())
        {
            $horasVoltajes[] = $row["HORA"];
            $voltajes[] = $row['voltajeMedido'];
        }
    }
    else
    {
        echo "Error en ejecucion";
    }
    $sql->close();
    $conn->close();
?>