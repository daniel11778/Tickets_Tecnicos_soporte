<?php
session_start();

$host = "localhost";
$usuario_db = "root";
$contrasena_db = "";
$basedatos = "tickets_tecnicos";


$conn = new mysqli($host, $usuario_db, $contrasena_db, $basedatos);

$descripcion = $_POST['descripcion'];
$fecha_apertura = $_POST['fecha_apertura'];
$estado = "pendiente";
$id_usuario = $_SESSION['usuario_id'];
//para crear el ticket
$sql = "INSERT INTO tickets (descripcion, estado, fecha_de_apertura, id_usuario) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $descripcion, $estado, $fecha_apertura,$id_usuario);
$stmt->execute();

$stmt->close();

//para jalar los datos de la base de datos y crear la tabla
$sql2 = "SELECT id, descripcion, estado, fecha_de_apertura, fecha_de_cierre 
FROM tickets
WHERE id_usuario = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id_usuario);
$stmt2->execute();
$resultado = $stmt2->get_result();

echo "<table border='1' cellpadding='5'>";
echo "<tr>
        <th>ID</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Fecha de apertura</th>
        <th>Fecha de cierre</th>
      </tr>";

// filas de resultados
while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $fila['id'] . "</td>";
    echo "<td>" . $fila['descripcion'] . "</td>";
    echo "<td>" . $fila['estado'] . "</td>";
    echo "<td>" . $fila['fecha_de_apertura'] . "</td>";
    echo "<td>" . $fila['fecha_de_cierre'] . "</td>";
    echo "</tr>";
}

echo "</table>";




$stmt2->close();
$conn->close();
?>
