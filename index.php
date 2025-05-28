<?php
// Configura los datos de conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "bcg";

// Intentar conexión
$conn = new mysqli($host, $usuario, $contrasena, $basededatos);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Obtener y sanitizar los datos
$nombre = $conn->real_escape_string($_POST['nombre']);
$correo = $conn->real_escape_string($_POST['correo']);
$mensaje = $conn->real_escape_string($_POST['mensaje']);

// Insertar en la base de datos
$sql = "INSERT INTO mensajes (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensaje Enviado</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f0f0, #dfe6e9);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mensaje {
            background: #ffffff;
            padding: 60px 50px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2); /* Difuminado elegante */
            text-align: center;
            max-width: 600px;
            width: 90%;
            animation: fadeIn 0.5s ease-in-out;
        }

        h2 {
            font-size: 40px;
            margin-bottom: 20px;
            color: #2d3436;
        }

        p {
            font-size: 22px;
            color: #636e72;
        }

        a.boton-volver {
            display: inline-block;
            margin-top: 40px;
            background: #000000;
            color: #ffffff;
            padding: 18px 40px;
            font-size: 22px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a.boton-volver:hover {
            background: #2d3436;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="mensaje">
        <?php
        if ($conn->query($sql) === TRUE) {
            echo "<h2>✅ Mensaje enviado con éxito</h2>";
        } else {
            echo "<h2>❌ Error al enviar el mensaje</h2><p>" . $conn->error . "</p>";
        }
        $conn->close();
        ?>
        <a href="javascript:history.back()" class="boton-volver">⬅ Volver</a>
    </div>
</body>
</html>
