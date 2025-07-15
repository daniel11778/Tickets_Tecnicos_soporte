<?php
$host = "localhost";
$usuario_db = "root";
$contrasena_db = "";
$basedatos = "tickets_tecnicos";

// Conexión
$conn = new mysqli($host, $usuario_db, $contrasena_db, $basedatos);




// Recoger los datos del formulario
$descripcion = $_POST['descripcion'];
$fecha_apertura = $_POST['fecha_apertura'];
$estado = "pendiente"; // Default al crear

// Preparar SQL
$sql = "INSERT INTO tickets (descripcion, estado, fecha_de_apertura) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $descripcion, $estado, $fecha_apertura);

// Ejecutar
if ($stmt->execute()) {
    echo "Ticket creado correctamente.";
} else {
    echo "Error al crear el ticket: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
