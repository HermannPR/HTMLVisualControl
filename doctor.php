<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor - VisualControl</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="doctor.css">
    <link rel="stylesheet" href="buttons.css"> <!-- Link to buttons.css -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="header-placeholder"></div>
    <body>
        <section id="doctor">
            <h2>Página del Doctor</h2>
            <p>Bienvenido a tu perfil. Aquí podrás gestionar tus pacientes y configuraciones.</p>
            <div class="button-container">
                <a href="registrodoctor.html" class="button large">Registrar Doctor</a>
                <a href="registropaciente.html" class="button large">Registrar Paciente</a>
            </div>
        </section>
        <main>
            <select id="pacienteSelect">
                <option value="">Seleccione un paciente</option>
            </select>
            <canvas id="graficoVoltajes" width="400" height="200"></canvas>
            <script>
                let data = {};

                // Fetch data from dataD.php
                fetch('dataD.php')
                    .then(response => response.json())
                    .then(json => {
                        if (json.error) {
                            alert(json.error);
                        } else {
                            data = json;
                            const select = document.getElementById('pacienteSelect');
                            for (const id in data) {
                                const option = document.createElement('option');
                                option.value = id;
                                option.textContent = `Paciente ${id}`;
                                select.appendChild(option);
                            }
                        }
                    });

                document.getElementById('pacienteSelect').addEventListener('change', function() {
                    const id = this.value;
                    if (id && data[id]) {
                        const ctxVoltajes = document.getElementById('graficoVoltajes').getContext('2d');
                        const graficoVoltajes = new Chart(ctxVoltajes, {
                            type: 'line',
                            data: {
                                labels: data[id].horas.map(hora => `${hora}:00`), // Convertir las horas a formato "HH:00"
                                datasets: [{
                                    label: 'Voltajes',
                                    data: data[id].voltajes,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Horas'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Voltaje'
                                        }
                                    }
                                }
                            }
                        });
                    }
                });
            </script>
        </main>
    </body>

    <!-- Footer -->
    <div id="footer-placeholder"></div>
    <script src="script.js"></script>
</body>
</html>