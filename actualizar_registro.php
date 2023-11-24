<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];

    $sql = "UPDATE personas SET ";
    $params = array();
    $updateFields = array();


    $columns = ['id', 'nombre', 'nombredos', 'apellido', 'apellidodos', 'cedula', 'direccion', 'telefono', 'correo', 'estadocivil', 'fechanacimiento', 'sexo', 'peso', 'tallacalzado', 'gradodeinstruccion', 'profesion', 'discapacidad', 'enfermedad', 'poseevivienda', 'tipovivienda'];

    foreach ($columns as $column) {

        if (isset($_POST[$column])) {
            $updateFields[] = $column . " = ?";
            $params[] = $_POST[$column];
        }
    }

    if (empty($updateFields)) {

        $response = ['success' => false, 'message' => 'No se proporcionaron campos válidos para actualizar.'];
    } else {

        $sql .= implode(", ", $updateFields);
        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);

        if ($stmt->execute()) {

            $response = ['success' => true, 'message' => 'Los cambios se guardaron correctamente.'];
        } else {

            $response = ['success' => false, 'message' => 'Error al guardar los cambios.'];
        }
    }

    echo json_encode($response);
} else {

    echo "Acceso denegado";
}
