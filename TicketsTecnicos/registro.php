<?php
$host = "localhost";
$usuario_db = "root";
$contrasena_db = ""; 
$basedatos = "tickets_tecnicos";

$conn = new mysqli($host, $usuario_db, $contrasena_db, $basedatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$usuario = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

$rol = 3;

$sql = "INSERT INTO users (usuario, correo, contraseña, rol) VALUES (usuario, correo, contraseña, rol)";
$stmt = $conn->prepare($sql);
$stmt->bind_param($usuario, $correo, $contrasena_hash, $rol);

if ($stmt->execute()) {
    echo "Registro exitoso.";
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
