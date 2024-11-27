<?php
    
    include('conexion.php');
    if (isset($_SESSION['IDCuenta'])) {
        $IDCuenta = $_SESSION['IDCuenta'];
        date_default_timezone_set("America/Mexico_City");
        $datetime = new DateTime();
        $dia = $datetime->format("d");
        $IDElectrodos = [];

        $sql1 = $conn->prepare("SELECT pID FROM usuarios WHERE IDCuenta = ?");
        $sql1->bind_param("i", $IDCuenta);
        $sql1->execute();
        $result1 = $sql1->get_result();
        $row1 = $result1->fetch_assoc();
        $pID = $row1["pID"];
    
        $sql2 = $conn->prepare("SELECT IDElectrodo FROM electrodos WHERE pID = ?");
        $sql2->bind_param("i", $pID);
        $sql2->execute();
        $result2 = $sql2->get_result();
        while($row2 = $result2->fetch_assoc())
        {
            $IDElectrodos[] = $row2['IDElectrodo'];
        }
        foreach($IDElectrodos as $ID)
        {
            $sql = $conn->prepare("SELECT HOUR(hora) AS HORA, COUNT(*) AS TOTAL
            FROM voltaje
            WHERE electrodoID = ? AND DAY(fecha) = ?
            GROUP BY HOUR(hora)
            ORDER BY HORA");
            $sql->bind_param("ii", $IDElectrodos, $dia);
        
            if($sql->execute())
            {
                $result = $sql->get_result();
                $horas = [];
                $totales = [];
                $totalSum = 0;
                while($row = $result->fetch_assoc())
                {
                    $horas[] = $row['HORA'];
                    $totales[] = $row['TOTAL'];
                    $totalSum += $row['TOTAL'];
                }
            }
            else
            {
                echo "Error en ejecucion";
            }
        }
    }
    else 
    {
        echo "No se encontró el ID de la cuenta";
    }

    $sql->close();
    $conn->close();
?>