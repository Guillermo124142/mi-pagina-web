<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "usuario_mysql", "tu_contraseña", "amyyemporio");

// Verifica conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];
$confirmar = $_POST['confirmar'];

// Validación básica
if ($contrasena !== $confirmar) {
  die("Las contraseñas no coinciden.");
}

// Encriptar contraseña
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Preparar la consulta
$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, telefono, contrasena) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $email, $telefono, $contrasena_hash);

// Ejecutar
if ($stmt->execute()) {
  echo "Usuario registrado exitosamente.";
  // Redirigir o mostrar mensaje personalizado
} else {
  echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
