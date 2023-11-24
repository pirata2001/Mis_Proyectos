<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <!-- Bootstrap - CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <style>
        #paginadorbtn {
            margin-top: 100px;
        }

        #icon {
            font-size: 20px;
            padding: 8px;
            text-decoration: none;

        }

        #icon-t {
            font-size: 20px;
            padding: 8px;
            text-decoration: none;

        }

        #icon-t:hover {
            color: red;

        }
        #icon-exit {
    position: absolute;
    top: 5px;
    right: 5px;
    color: #fff; /* Color del icono */
    background-color: #d9534f; /* Color de fondo del botón */
    padding: 5px;
    border-radius: 50%; /* Forma del botón (circular) */
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s; /* Efecto de transición al pasar el ratón */
  }


        #icon-exit:hover {
            color: #d90000;
        }

        .hidden-details {
            display: none;
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            overflow: hidden;

        }

        .details-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            max-width: 90%;
            max-height: 80%;
            overflow: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .details-container h5 {
            margin-top: 0;
        }

        .details-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-container th,
        .details-container td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        .details-container th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .details-container td {
            background-color: #fff;
        }

        #paginadorbtn {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 0;
            margin-bottom: 40px;
        }
    </style>
</head>
<?php
include("includes/navbar.php");
include("includes/footer.php");
?>
<?php
require 'config.php';
$query = "SELECT id, nombre, nombredos, apellido, apellidodos, cedula, direccion, telefono, correo, estadocivil, fechanacimiento, discapacidad, enfermedad, poseevivienda, tipovivienda, TIMESTAMPDIFF(YEAR, fechanacimiento, CURDATE()) AS edad_actual FROM personas WHERE 1=1";
?>
<body>
    <main>
        <div class="container py-4 text-center">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                        <select name="num_registros" id="num_registros" class="form-control">
                            <option value="5">5</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
                <!-- Modal Oculto -->
                <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Parametros de filtrado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body small">
                        <div class="row">
                            <div class="col-2">
                                <select name="sexo" id="sexo" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            Genero
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <select name="poseevivienda" id="poseevivienda" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="SI">Si</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                            Posee vivienda
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" name="campo" id="campo" class="form-control" placeholder="Buscar...">
                        <button class="btn btn-primary" type="button" onclick="getData()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-auto">
                    <button id="btn-add-user" class="btn btn-primary" onclick="window.location.href='form_agg_habitante.php';">
                        <i class="fas fa-user-plus"></i> Agregar Habitante
                    </button>
                </div>
                <div class="col-auto">
                    <button id="btn-refresh" class="btn btn-primary">
                        <i class="fas fa-sync"></i> Refrescar Tabla y Filtros
                    </button>
                </div>
            </div>
            <div class="row py-4">
                <div class="col">
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <th class="sort asc">#</th>
                            <th class="sort asc">Cedula</th>
                            <th class="sort asc">Nombre</th>
                            <th class="sort asc">Apellido</th>
                            <th class="sort asc">Teléfono</th>
                            <th class="sort asc">Correo</th>
                            <th class="sort asc">Edad</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                        <!-- El id del cuerpo de la tabla. -->
                        <tbody id="content">
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row align-items-end" id="paginadorbtn">
                <div class="col-6">
                    <label id="lbl-total"></label>
                </div>
                <div class="col-6" id="nav-paginacion"></div>
                <input type="hidden" id="pagina" value="1">
                <input type="hidden" id="orderCol" value="0">
                <input type="hidden" id="orderType" value="asc">
            </div>
        </div>
    </main>
    <script src="js/jquery.min.js"></script>
    <script>
        /* Llamando a la función getData() */
        getData();
        /* Escuchar eventos change y keyup en los campos y botones relevantes */
        document.getElementById("campo").addEventListener("keyup", function() {
            getData();
        }, false);
        document.getElementById("num_registros").addEventListener("change", function() {
            getData();
        }, false);
        document.getElementById("sexo").addEventListener("change", function() {
            getData();
        }, false);
        document.getElementById("poseevivienda").addEventListener("change", function() {
            getData();
        }, false);

        /* Peticion AJAX */
        function getData() {
            let input = document.getElementById("campo").value
            let num_registros = document.getElementById("num_registros").value
            let content = document.getElementById("content")
            let pagina = document.getElementById("pagina").value
            let orderCol = document.getElementById("orderCol").value
            let orderType = document.getElementById("orderType").value
            let sexo = document.getElementById("sexo").value
            let poseevivienda = document.getElementById("poseevivienda").value;
            
            if (pagina == null) {
                pagina = 1
            }

            let url = "load.php"
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('registros', num_registros)
            formaData.append('sexo', sexo)
            formaData.append('poseevivienda', poseevivienda)
            formaData.append('pagina', pagina)
            formaData.append('orderCol', orderCol)
            formaData.append('orderType', orderType)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data.data
                    document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro +
                        ' de ' + data.totalRegistros + ' registros'
                    document.getElementById("nav-paginacion").innerHTML = data.paginacion
                }).catch(err => console.log(err))
        }

        function nextPage(pagina) {
            document.getElementById('pagina').value = pagina
            getData()
        }

        let columns = document.getElementsByClassName("sort")
        let tamanio = columns.length
        for (let i = 0; i < tamanio; i++) {
            columns[i].addEventListener("click", ordenar)
        }

        function ordenar(e) {
            let elemento = e.target

            document.getElementById('orderCol').value = elemento.cellIndex

            if (elemento.classList.contains("asc")) {
                document.getElementById("orderType").value = "asc"
                elemento.classList.remove("asc")
                elemento.classList.add("desc")
            } else {
                document.getElementById("orderType").value = "desc"
                elemento.classList.remove("desc")
                elemento.classList.add("asc")
            }

            getData()
        }
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Funcion de div Oculto -->
    <script>
        function toggleDetails(rowId) {
            var detailsRow = document.getElementById(rowId);

            if (detailsRow) {
                if (detailsRow.style.display === 'none') {
                    detailsRow.style.display = 'table-row';
                } else {
                    detailsRow.style.display = 'none';
                }
            }
        }
    </script>
    <!-- Funcion de div Oculto de editar -->
    <script>
        function toggleEdit(rowId) {
            var edtitRow = document.getElementById(rowId);

            if (edtitRow) {
                if (edtitRow.style.display === 'none') {
                    edtitRow.style.display = 'table-row';
                } else {
                    edtitRow.style.display = 'none';
                }
            }
        }
    </script>
    <script>
        function guardarCambios(id) {
            // Obtener los datos del formulario
            var formData = new FormData(document.getElementById('updateForm_' + id));
            // Realizar una solicitud AJAX para enviar los datos al servidor
            $.ajax({
                url: 'actualizar_registro.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Manejar la respuesta del servidor
                    alert('Los cambios se guardaron correctamente.');
                    // Ocultar el formulario de edición
                    toggleEdit('modificar_' + id);
                },
                error: function() {
                    // Manejar errores si es necesario
                    alert('Error al guardar los cambios.');
                }
            });
        }
    </script>
    <script>
        // Manejador de eventos al botón de actualización
        document.getElementById("btn-refresh").addEventListener("click", function() {
            // Llamar a la función getData() para cargar nuevamente los datos de la tabla y restablecer los filtros
            getData();
            // Restablecer los filtros si es necesario
            document.getElementById("campo").value = ""; // Campo de búsqueda
            document.getElementById("sexo").value = ""; // Filtro de sexo
            document.getElementById("poseevivienda").value = ""; // Filtro de poseevivienda
        }, false);
    </script>
    <!-- Funcion para convertir en mayusculas -->
    <script>
        function convertirAMayusculas(inputId) {
            var input = document.getElementById(inputId);
            if (input.value) {
                input.value = input.value.toUpperCase();
            }
        }
    </script>
<script>
    function sanitizeInput(input) {
        // Convierte el valor del campo a mayúsculas
        input.value = input.value.toUpperCase();

        // Verifica el tipo de campo y aplica la sanitización según sea necesario
        if (input.id === 'cedula' || input.id === 'telefono') {
            // Elimina caracteres no numéricos
            input.value = input.value.replace(/[^\d]/g, '');
        } else if (input.id !== 'direccion' && input.id !== 'correo') {
            // Elimina caracteres no permitidos (deja solo letras y espacios)
            input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
        }
    }
</script>


<script src="js/sweetalert2.all.min.js"></script>

<script>
// ... Tu código JavaScript existente ...

// Función para eliminar un registro y realizar acciones adicionales después de la eliminación exitosa
function eliminarRegistro(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            // Hacer la petición para eliminar el registro
            $.ajax({
                url: 'clean_perso.php?id=' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Si la eliminación fue exitosa, mostrar SweetAlert2 de éxito
                        Swal.fire({
                            title: '¡Eliminado!',
                            text: response.message,
                            icon: 'success'
                        });

                        // Ejecutar acciones adicionales después de la eliminación exitosa
                        // Por ejemplo, hacer clic en el botón de "Refrescar Tabla y Filtros"
                        $('#btn-refresh').click();
                    } else {
                        // Manejar otros casos (por ejemplo, si hubo un error en el servidor)
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un error al intentar eliminar el registro.',
                            icon: 'error'
                        });
                    }
                },
                error: function() {
                    // Manejar errores de conexión u otros errores
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error al intentar eliminar el registro.',
                        icon: 'error'
                    });
                }
            });
        }
    });
}

// ... Tu código JavaScript existente ...

</script>









</body>
</html>