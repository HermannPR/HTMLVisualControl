<?php
    include 'conexion.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nombre=$_POST['nombre'];
        $apellido = $_POST['apellido'];
        $enfermedad = $_POST['enfermedad'];
        $IDDoctor = $_POST['iddoctor'];
        $username = $_POST['usernamep'];
        $password = $_POST['passwordp'];
        $electrodo1 = 'ud';
        $electrodo2 = 'lr';
        $electrodo3 = 'emg';

        // Preparar la primera consulta para insertar en la tabla paciente
        $sql = $conn->prepare("INSERT INTO paciente (Nombre, Apellido, Enfermedad, IDDoctor) VALUES (?, ?, ?, ?)");
        $sql->bind_param("sssi", $nombre, $apellido, $enfermedad, $IDDoctor);

        if ($sql->execute()) 
        {
            echo "Primer insert realizado con éxito" . "<br>";
            $rol = "usuario";

            // Preparar la consulta para seleccionar el pID del paciente recién insertado
            $Select = $conn->prepare("SELECT pID FROM paciente WHERE Nombre = ? AND Apellido = ?");
            $Select->bind_param("ss", $nombre, $apellido);

            if ($Select->execute()) 
            {
                echo "Consulta realizada con éxito" . "<br>";
                $result = $Select->get_result();
                $row = $result->fetch_assoc();
                if ($row) 
                {
                    $pID = $row['pID'];

                    // Preparar la segunda consulta para insertar en la tabla usuarios
                    $sql2 = $conn->prepare("INSERT INTO usuarios (username, password, Nombre, Apellido, rol, pID) VALUES (?, ?, ?, ?, ?, ?)");
                    $sql2->bind_param("sssssi", $username, $password, $nombre, $apellido, $rol, $pID);

                    if ($sql2->execute()) 
                    {
                        echo "Segundo insert realizado con éxito" . "<br>";
                        $insertEl1 = $conn->prepare("INSERT INTO electrodos (funcionamiento, pID) VALUES(?,?)");
                        $insertEl1->bind_param("si",$electrodo1,$pID);

                        if($insertEl1->execute())
                        {
                            echo "Electrodo 1 insertado con éxito" . "<br>";
                            $insertEL2 = $conn->prepare("INSERT INTO electrodos (funcionamiento, pID) VALUES(?,?)");
                            $insertEL2->bind_param("si",$electrodo2, $pID);

                            if($insertEL2->execute())
                            {
                                echo "Electrodo2 insertado correctamente". "<br>";
                                $insertEL3 = $conn->prepare("INSERT INTO electrodos (funcionamiento, pID) VALUES(?,?)");
                                $insertEL3->bind_param("si",$electrodo3, $pID);

                                if($insertEL3->execute())
                                {
                                    echo "Electrodo3 insertado correctamente". "<br>";
                                }
                                else
                                {
                                    echo "Error en el insert del electrodo 3: " . $insertEL3->error . "<br>";
                                }
                            }
                            else
                            {
                                echo "Error en el insert del electrodo 2: " . $insertEL2->error . "<br>";
                            }
                        } 
                        else 
                        {
                            echo "Error en el insert del electrodo 1: " . $insertEl1->error . "<br>";
                        }
                    } 
                    else
                    {
                        echo "Error en el segundo insert: " . $sql2->error . "<br>";
                    }
                } 
                else 
                {
                    echo "No se encontró el pID del paciente" . "<br>";
                }
            } 
            else 
            {
                echo "Error en la consulta: " . $Select->error . "<br>";
            }
        } 
        else 
        {
            echo "Error en el primer insert: " . $sql->error . "<br>";
        }
        header("Location:/doctor.php");
        exit();
    }
?>