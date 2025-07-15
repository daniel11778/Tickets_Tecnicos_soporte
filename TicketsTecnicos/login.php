<?php
$host = "localhost";
$usuario_db = "root";
$contrasena_db = ""; 
$basedatos = "tickets_tecnicos";

$conn = new mysqli($host, $usuario_db, $contrasena_db, $basedatos);
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];


$sql = "SELECT contraseña FROM users WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    $contrasena_hash = $fila['contraseña'];

    if (password_verify($contrasena, $contrasena_hash)) {
        echo "Inicio de sesión exitoso.";
    } else {
        echo "Datos incorrectos";
    }}
 
$stmt->close();
$conn->close();
?>