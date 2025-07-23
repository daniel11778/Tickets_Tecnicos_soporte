<?php
$host = "localhost";
$usuario_db = "root";
$contrasena_db = "";
$basedatos = "tickets_tecnicos";


$conn = new mysqli($host, $usuario_db, $contrasena_db, $basedatos);

$descripcion = $_POST['descripcion'];
$fecha_apertura = $_POST['fecha_apertura'];
$estado = "pendiente";

$sql = "INSERT INTO tickets (descripcion, estado, fecha_de_apertura) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $descripcion, $estado, $fecha_apertura);

$sql2 = "SELECT id, descripcion, estado, fecha_de_apertura 
FROM tickets
WHERE id_usuario = ?";
$stmt = $conn->prepare($sql2);


if ($stmt->execute()) {
    echo "Ticket creado correctamente.";
} else {
    echo "Error al crear el ticket: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
