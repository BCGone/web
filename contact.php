<?php
// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "bcg";

$conn = new mysqli($host, $usuario, $contrasena, $basededatos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Sanitizar entradas
$nombre = $conn->real_escape_string($_POST['nombre']);
$correo = $conn->real_escape_string($_POST['correo']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$asunto = $conn->real_escape_string($_POST['asunto']);
$mensaje = $conn->real_escape_string($_POST['mensaje']);

// Insertar en la base de datos
$sql = "INSERT INTO contactame (nombre, correo, telefono, asunto, mensaje) 
        VALUES ('$nombre', '$correo', '$telefono', '$asunto', '$mensaje')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('✅ Mensaje enviado con éxito'); window.location.href='contact.html';</script>";
} else {
    echo "❌ Error: " . $conn->error;
    }

$conn->close();
?>
