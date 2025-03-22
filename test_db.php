<?php
require_once 'config/database.php';

$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo "Conexión exitosa.";
} else {
    echo "Error en la conexión.";
}
?>
