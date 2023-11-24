<?php
// Elimina Habitante
include_once("config.php");
$cod = $_GET['id'];
mysqli_query($conn, "DELETE FROM personas WHERE id=$cod");
// Después de eliminar con éxito, envía una respuesta JSON con éxito
$response = [
    'success' => true,
    'message' => 'Registro eliminado con éxito.'
];

echo json_encode($response);
exit;
?>