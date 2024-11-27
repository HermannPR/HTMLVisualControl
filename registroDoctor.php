<?php
    include 'conexion.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $username = $_POST['usernamed'];
        $password = $_POST['passwordd'];
        $pID = $_POST['pid'];
        $rol = 'doctor';

        $insert = $conn->prepare("INSERT INTO doctor (Nombre, Apellido, pID) VALUES (?, ?, ?)");
        $insert->bind_param("ssi", $nombre, $apellido, $pID);
        if($insert->execute())
        {
            echo "Datos insertados correctamente" . "<br>";
            $consult = $conn->prepare("SELECT IDDoctor FROM doctor WHERE Nombre = ? AND Apellido = ?");
            $consult->bind_param("ss", $nombre, $apellido);
            $consult->execute();
            $result = $consult->get_result();
            $row = $result->fetch_assoc();
            $dID = $row['dID'];

            $insert2 = $conn->prepare("INSERT INTO usuarios (username, password, Nombre, Apellido, rol, IDDoctor) VALUES (?, ?, ?, ?, ?, ?)");
            $insert2->bind_param("sssssi", $username, $password, $nombre, $apellido, $rol, $dID);
            if($insert2->execute())
            {
                echo "Datos insertados correctamente" . "<br>";
            }
            else
            {
                echo "Error al insertar datos" . "<br>";
            }
        }
        header("Location:/doctor.php");
        exit();
    }
?>