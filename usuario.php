<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario - VisualControl</title>
    <link rel="stylesheet" href="global.css"/>
    <link rel="stylesheet" href="header.css"/>
    <link rel="stylesheet" href="footer.css"/>
    <link rel="stylesheet" href="usuario.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div id="header-placeholder"></div>
    <main>
        <section id="usuario">
            <h2>Página del Usuario</h2>
            <?php
            include("conexion.php");
            date_default_timezone_set('America/Mexico_City');
            session_start();

            if (isset($_SESSION['Nombre'])) {
                $nombre = $_SESSION['Nombre'];
                $IDCuenta = $_SESSION['IDCuenta'];
                echo "<p>Bienvenido, " . htmlspecialchars($nombre) . "</p>";   
            } else {
                echo "<script>alert('No has iniciado sesión'); window.location.href = 'login.php';</script>";
            }
            ?>
            <?php include('data.php'); ?>
            <p>El día de hoy realizó <?php echo $totalSum ?> usos con VisualControl</p>
            <?php include('data2.php'); ?>
        </section>
    </main>
    <canvas id="graficoHoras" width="400" height="200"></canvas>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        const horas = <?php echo json_encode($horas); ?>;
        const totales = <?php echo json_encode($totales); ?>;
        const horasVoltajes = <?php echo json_encode($horasVoltajes); ?>;
        const voltajes = <?php echo json_encode($voltajes); ?>;
        const titulo = 'Registros por hora'
        const ctxHoras = document.getElementById('graficoHoras').getContext('2d');
        const graficoHoras = new Chart(ctxHoras, {
            type: 'bar',
            data: {
                labels: horas.map(hora => `${hora}:00`), // Convertir las horas a formato "HH:00"
                datasets: [{
                    label: 'Registros por hora',
                    data: totales,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                        title: {
                            display: true,
                            text: titulo,
                            font: {
                                size: 50 
                            }
                        }
                    },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Hora'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Registros'
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // Obtener los datos de la variable de sesión PHP
        const data = <?php echo json_encode($_SESSION['data3']); ?>;
        const titulo1 = 'Grafica de cantidad de actuadores'
        
        if (data) {
            const ctx = document.getElementById('myChart').getContext('2d');
            const labels = data.map(item => item.IDActuador);
            const values = data.map(item => item.cantidad);

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad de usos',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: titulo1,
                            font: {
                                size: 50 
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Actuador'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Cantidad de usos'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
    <!-- Footer -->
    <div id="footer-placeholder"></div>
    <script src="script.js"></script>
</body>
</html>