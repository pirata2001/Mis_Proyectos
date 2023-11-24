<?php
require 'config.php';
/*arreglo de las columnas a mostrar en la tabla */
$columns = ['id', 'nombre', 'nombredos', 'apellido', 'apellidodos', 'cedula', 'direccion', 'telefono', 'correo', 'estadocivil', 'fechanacimiento', 'sexo', 'peso', 'tallacalzado', 'gradodeinstruccion', 'profesion', 'discapacidad', 'enfermedad', 'poseevivienda', 'tipovivienda'];

/* Nombre de la tabla */
$table = "personas";
$id = 'id';
$sexo = isset($_POST['sexo']) ? $conn->real_escape_string($_POST['sexo']) : '';
$poseevivienda = isset($_POST['poseevivienda']) ? $conn->real_escape_string($_POST['poseevivienda']) : '';
$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;
/* Filtrado */
$where = '';
if (!empty($campo)) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

if (!empty($sexo)) {
    if (!empty($where)) {
        $where .= " AND ";
    } else {
        $where = "WHERE ";
    }
    $where .= "sexo = '$sexo'";
}

if (!empty($poseevivienda)) {
    if (!empty($where)) {
        $where .= " AND ";
    } else {
        $where = "WHERE ";
    }
    $where .= "poseevivienda = '$poseevivienda'";
}


/* Limite */
$limit = isset($_POST['registros']) ? $conn->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $conn->real_escape_string($_POST['pagina']) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

/**
 * Ordenamiento
 */

$sOrder = "";
if (isset($_POST['orderCol'])) {
    $orderCol = isset($_POST['orderCol']) ? intval($_POST['orderCol']) : 0;
    $orderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';

    $sOrder = "ORDER BY " . $columns[$orderCol] . ' ' . $orderType;
}

/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . ",
    TIMESTAMPDIFF(YEAR, fechanacimiento, CURDATE()) AS edad

FROM $table
$where
$sOrder
$sLimit";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conn->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT count($id) FROM $table ";
$resTotal = $conn->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0] ?? 0;

//* Calcular Edad
$edad_actual = "SELECT TIMESTAMPDIFF(YEAR, fechanacimiento, CURDATE()) AS edad_actual FROM personas";
/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';
if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $output['data'] .= '<tr>';
        
        //Raspado de Campos de la DB
        $output['data'] .= '<td>' . $row['id'] . '</td>';
        $output['data'] .= '<td>' . $row['cedula'] . '</td>';
        $output['data'] .= '<td>' . $row['nombre'] . '</td>';
        $output['data'] .= '<td>' . $row['apellido'] . '</td>';
        $output['data'] .= '<td>' . $row['telefono'] . '</td>';
        $output['data'] .= '<td>' . $row['correo'] . '</td>';
        $output['data'] .= '<td>' . $row['edad'] . '</td>';
        //Botones 
        $output['data'] .= '<td><a id="icon" class="fas fa-address-book" href="javascript:void(0);" onclick="toggleDetails(\'details_' . $row['id'] . '\')"></a></td>'; //Este Boton llama al Div Oculto
        $output['data'] .= '<td><a id="icon" class="fas fa-edit" href="javascript:void(0);" onclick="toggleEdit(\'modificar_' . $row['id'] . '\')"></a></td>'; //Este Boton llama al Div Oculto
        $output['data'] .= "<td><a id='icon-t' class='fas fa-trash' href='javascript:void(0)' onclick='eliminarRegistro(" . $row['id'] . ")'></a></td>";
        $output['data'] .= '<td><a id="icon" class="fas fa-file" href="reportes.php?id=' . $row['id'] . '" onClick="return confirm(\'¿Estás seguro de que deseas descargar este archivo?\')" target="_blank"></a></td>';
        //Tabla de Detalles Oculta
        $output['data'] .= '<tr class="hidden-details" id="details_' . $row['id'] . '">';
        $output['data'] .= '<td colspan="10">';
        // Mostrar detalles personalizados
        $output['data'] .= '<div class="details-container">';
        $output['data'] .=  '<a id="icon-exit" class="fas fa-window-close" href="javascript:void(0);" onclick="toggleDetails(\'details_' . $row['id'] . '\')"></a>';
        $output['data'] .= '<br>';
        $output['data'] .= '<h5>Mas acerca de ' . $row['nombre'] . ' ' . $row['apellido'] . '</h5>';
        $output['data'] .= '<p><strong>F/N</strong> ' . $row['fechanacimiento'] . '</p>';
        $output['data'] .= '<p><strong>Estado Civil:</strong> ' . $row['estadocivil'] . '</p>';
        $output['data'] .= '<p><strong>Profesion:</strong> ' . $row['profesion'] . '</p>';
        $output['data'] .= '<p><strong>Sexo:</strong> ' . $row['sexo'] . '</p>';
        $output['data'] .= '<p><strong>Peso (KG):</strong> ' . $row['peso'] . '</p>';
        $output['data'] .= '<p><strong>Talla de calzado:</strong> ' . $row['tallacalzado'] . '</p>';
        $output['data'] .= '<p><strong>Discacapidad:</strong> ' . $row['discapacidad'] . '</p>';
        $output['data'] .= '<p><strong>Enfermedad:</strong> ' . $row['enfermedad'] . '</p>';
        $output['data'] .= '<p><strong>Posee vivienda</strong> ' . $row['poseevivienda'] . '</p>';
        $output['data'] .= '<p><strong>Tipo de vivienda:</strong> ' . $row['tipovivienda'] . '</p>';
        // ... Agregar más ...
        $output['data'] .= '</div>';
        $output['data'] .= '</td>';
        // Modificar Registro
        $output['data'] .= '<tr class="hidden-details" id="modificar_' . $row['id'] . '">';
        $output['data'] .= '<td colspan="10">';
        $output['data'] .= '<div class="details-container">';
        $output['data'] .= '<a id="icon-exit" class="fas fa-window-close" href="javascript:void(0);" onclick="toggleEdit(\'modificar_' . $row['id'] . '\')"></a>';
        $output['data'] .= '<h6 class="mb-3">Modificar Registro</h6>';
        $output['data'] .= '<div class="table-responsive">';
        $output['data'] .= '<form id="updateForm_' . $row['id'] . '" class="needs-validation" novalidate>';
        $output['data'] .= '<div class="row">'; // Inicio de la fila
        
        // Array para simplificar los selects
        $selectOptions = [
            'sexo' => ['M' => 'M', 'F' => 'F'],
            'poseevivienda' => ['SI' => 'SI', 'NO' => 'NO'],
            'estadocivil' => ['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Concubinato'],
            'discapacidad' => ['No', 'Autismo', 'Síndrome de Asperger', 'Trastorno de Desarrollo', 'Deficiencia visual', 'Discapacidad física', 'Transtorno del lenguaje', 'Dificultades del aprendizaje', 'Discapacidad adutiva', 'Síndrome de Down', 'Síndromede Rett', 'Síndromede Asperger', 'Pérdida de memoria', 'Deterioro cognitivo', 'Discapacidad múltiple'],
            'enfermedad' => ['No', 'Hipertensión', 'Colesterol alto', 'Artritis', 'Cardiopatía isquémica', 'Diabetes', 'Enfermedad renal crónica', 'Insuficiencia cardiaca', 'Depresión', 'Enfermedad de Alzheimer', 'Otras formas de demencia', 'Enfermedad pulmonar', 'Enfermedad crónica múltiple'],
            'tipovivienda' => ['Ninguna', 'Casa', 'Chalet', 'Tienda', 'Choza', 'Piso', 'Rancho', 'Departamento', 'Quinta'],
            'gradodeinstruccion' => ['Ninguno', 'Básica', 'Bachiller', 'Técnico Medio', 'Universitario', 'Post Grado', 'Doctorado', 'PhD']
        ];
        
      // ...

// ...

// Recorre las columnas
foreach ($columns as $column) {
    $output['data'] .= '<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">'; // Columnas más anchas
    $output['data'] .= '<label for="' . $column . '" class="col-form-label">' . ucfirst($column) . ':</label>';

    // Verifica si la columna es un select
    if (array_key_exists($column, $selectOptions)) {
        $output['data'] .= '<select name="' . $column . '" id="' . $column . '" class="form-control" required>';
        foreach ($selectOptions[$column] as $optionValue => $optionLabel) {
            $output['data'] .= '<option value="' . $optionValue . '" ' . ($row[$column] == $optionValue ? 'selected' : '') . '>' . $optionLabel . '</option>';
        }
        $output['data'] .= '</select>';
    } else {
        // Campos de entrada de texto
        // Define los límites de caracteres específicos para cada campo
        $limitesCaracteres = [
            'nombre' => 20,
            'nombredos' => 20,
            'apellido' => 20,
            'apellidodos' => 20,
            'cedula' => 20,
            'direccion' => 100,
            'telefono' => 11,
            'correo' => 50,
            'estadocivil' => 20,
            'fechanacimiento' => 10,
            'sexo' => 1,
            'peso' => 3,
            'tallacalzado' => 2,
            'gradodeinstruccion' => 20,
            'profesion' => 20
        ];

        // ...

        // Bucle para generar campos de texto
        $output['data'] .= '<input type="text" name="' . $column . '" id="' . $column . '" class="form-control" oninput="sanitizeInput(this)" value="' . htmlspecialchars($row[$column]) . '" required';

        // Verifica si hay un límite específico para este campo
        if (array_key_exists($column, $limitesCaracteres)) {
            $output['data'] .= ' maxlength="' . $limitesCaracteres[$column] . '"';
        } else {
            // Si no hay un límite específico, aplica un límite predeterminado
            $output['data'] .= ' maxlength="50"';
        }
        $output['data'] .= '>';
    }

    $output['data'] .= '<div class="invalid-feedback">Este campo es requerido.</div>';
    $output['data'] .= '</div>';


// ...



// ...


        }
        
        $output['data'] .= '</div>'; // Cierre de la fila
        $output['data'] .= '<div class="form-group row">'; // Div para el botón
        $output['data'] .= '<div class="offset-sm-2 col-sm-10">'; // Offset para el botón
        $output['data'] .= '<button type="button" onclick="guardarCambios(' . $row['id'] . ')" class="btn btn-primary">Guardar</button>';
        $output['data'] .= '</div>'; // Cierre del div para el botón
        $output['data'] .= '</form>'; // Cierre del formulario
        $output['data'] .= '</div>'; // Cierre del contenedor responsive
        $output['data'] .= '</div>';
        $output['data'] .= '</td>';
        $output['data'] .= '</tr>';
        
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['totalRegistros'] > 0) {
    $totalPaginas = ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination justify-content-center">';

    $numeroInicio = 1;

    if (($pagina - 4) > 1) {
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 9;

    if ($numeroFin > $totalPaginas) {
        $numeroFin = $totalPaginas;
    }

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="nextPage(' . $i . ')">' . $i . '</a></li>';
        }
    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
