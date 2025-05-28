<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "bcg";

$conn = new mysqli($host, $usuario, $contrasena, $basededatos);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar comentario si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $website = $conn->real_escape_string($_POST["website"]);
    $mensaje = $conn->real_escape_string($_POST["mensaje"]);

    $sql = "INSERT INTO comentarios_blog (nombre, email, website, mensaje) 
            VALUES ('$nombre', '$email', '$website', '$mensaje')";

    if ($conn->query($sql) === TRUE) {
        echo "Comentario insertado correctamente.";
    } else {
        echo "Error al insertar comentario: " . $conn->error;
    }
}
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
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    text-align: center;
    max-width: 600px;
    width: 90%;
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

    </style>
</head>

