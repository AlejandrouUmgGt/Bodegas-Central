<?php

require_once 'vendor/autoload.php';

use SQLiteCloud\SQLiteCloudClient;
use SQLiteCloud\SQLiteCloudRowset;

$sqlite = new SQLiteCloudClient();
$sqlite->connectWithString("sqlitecloud://cvac9ls8nz.g1.sqlite.cloud:8860/Bodegas?apikey=YyIQxMbTom2b4amTVim7SubOOIQFHbFbOnjasyE9uoA");

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve parameters from the URL
    $quien_recibe = $_GET['quien_recibe'] ?? '';
    $cliente = $_GET['cliente'] ?? '';
    $quien_entrega = $_GET['quien_entrega'] ?? '';
    $no_factura = $_GET['no_factura'] ?? '';
    $descripcion = $_GET['descripcion'] ?? '';
    $cantidad = $_GET['cantidad'] ?? '';
    $tablename = $_GET['tablename'] ?? ''; // New variable from GET

    // Check if table name is provided
    if(empty($tablename)){
        echo "Error: No table name provided.";
        exit;
    }

    // Prepare SQL statement for inserting data
    $stmt = $sqlite->prepare("INSERT INTO $tablename (quien_recibe, cliente, quien_entrega, no_factura, descripcion, cantidad) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param('ssssss', $quien_recibe, $cliente, $quien_entrega, $no_factura, $descripcion, $cantidad);

    // Execute the statement for insertion
    if ($stmt->execute()) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }
}

// Execute a SELECT statement to retrieve data
$rowset = $sqlite->execute("SELECT * FROM $tablename"); // Use the variable here

// Fetch and display the results
while ($row = $rowset->fetch_assoc()) {
    echo "<p>Quien recibe: " . htmlspecialchars($row['quien_recibe']) . "</p>";
    echo "<p>Cliente: " . htmlspecialchars($row['cliente']) . "</p>";
    echo "<p>Quien entrega: " . htmlspecialchars($row['quien_entrega']) . "</p>";
    echo "<p>No. Factura: " . htmlspecialchars($row['no_factura']) . "</p>";
    echo "<p>Descripcion: " . htmlspecialchars($row['descripcion']) . "</p>";
    echo "<p>Cantidad: " . htmlspecialchars($row['cantidad']) . "</p>";
}

// Disconnect from the database
$sqlite->disconnect();

?>
