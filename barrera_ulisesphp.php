<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datosusuarios";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];

// Usar declaraciones preparadas para evitar inyección SQL
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param("sss", $nombre, $email, $hashed_password);

//Ejecutar la consulta
if ($stmt->execute() ===TRUE) {
    echo "Registro exitoso. Usuario creado correctamente";
} else {
    echo "Error al registrar usuario: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();

