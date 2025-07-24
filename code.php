<?php
// Conexión a la base de datos
$servername = "tu_servidor"; // Cambia esto por tu servidor
$username = "tu_usuario"; // Cambia esto por tu usuario
$password = "tu_contraseña"; // Cambia esto por tu contraseña
$dbname = "sql3791785"; // Cambia esto por tu nombre de base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$quienRecibe = $_POST['quienRecibe'];
$quienEntrega = $_POST['quienEntrega'];
$noFactura = $_POST['noFactura'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$numeroSerie = $_POST['numeroSerie'];

// Insertar datos en la tabla
$sql = "INSERT INTO Guatemala (QuienRecibe, QuienEntrega, NoFactura, Descripcion, Cantidad, NumeroSerie)
VALUES ('$quienRecibe', '$quienEntrega', '$noFactura', '$descripcion', $cantidad, '$numeroSerie')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>

