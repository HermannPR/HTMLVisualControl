<?php
    include('conexion.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = $conn->prepare("SELECT * 
        FROM usuarios 
        WHERE username = ? AND password = ?");
        $sql->bind_param("ss", $username, $password);
        if($sql->execute() === TRUE)
        {
            $result = $sql->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $nombre = $row['Nombre'];
                $IDCuenta = $row['IDCuenta'];
                $rol = $row['rol'];
                $IDDoctor = $row['IDDoctor'];
                $pID = $row['pID'];

                error_log("Nombre: " . $nombre);
                error_log("IDCuenta: " . $IDCuenta);
                session_start();
                $_SESSION['Nombre'] = $nombre;
                $_SESSION['IDCuenta'] = $IDCuenta;
                $_SESSION['IDDoctor'] = $IDDoctor;
                $_SESSION['pID'] = $pID;
                if($rol == 'usuario')
                {
                    header("Location: usuario.php");
                }
                else
                {
                    header("Location: doctor.php");
                }
                exit();
            }
            else
            {
                echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href = 'login.php';</script>";
            }
        }
        else
        {
            echo "Error en la ejecucion";
        }
    }
?>