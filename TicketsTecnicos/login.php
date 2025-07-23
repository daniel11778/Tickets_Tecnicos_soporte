<?php

session_start();

$host = "localhost";
$usuario_db = "root";
$contrasena_db = ""; 
$basedatos = "tickets_tecnicos";

$conn = new mysqli($host, $usuario_db, $contrasena_db, $basedatos);
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];


$sql = "SELECT id, rol, contraseña FROM users WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

    if (password_verify($contrasena, $fila['contraseña'])) {
        $_SESSION['usuario_id'] = $fila['id'];
        $_SESSION['rol'] = $fila['rol'];

       
            header("Location: crear_tickets.html");
        
        exit;
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}



$stmt->close();
$conn->close();
?>