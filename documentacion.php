<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

include("includes/navbar.php");
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentación de SAREJ</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <meta name="theme-color" content="#7952b3">
</head>

<body>
    <main>
        <div class="container py-5">
            <h1 class="pb-2 border-bottom">Documentación de SAREJ</h1>

            <h2>Introducción</h2>
            <p>¡Bienvenido a la documentación de SAREJ! Aquí encontrarás información importante sobre el sistema y cómo utilizarlo.</p>

            <h2>Tecnologías Utilizadas</h2>
            <p>En SAREJ, utilizamos las siguientes tecnologías:</p>
            <ul>
                <li>PHP (Hypertext Preprocessor)</li>
                <li>MySQL</li>
                <li>HTML (HyperText Markup Language)</li>
                <li>CSS (Cascading Style Sheets)</li>
                <li>JavaScript</li>
                <li>Bootstrap</li>
                <li>jQuery</li>
                <li>AJAX (Asynchronous JavaScript and XML)</li>
                <li>JSON (JavaScript Object Notation)</li>
            </ul>

            <h2>Derechos de Autor</h2>
            <p>Este sistema está protegido por derechos de autor. Todos los derechos están reservados.</p>

            <h2>Descargar Manual (PDF)</h2>
            <a href="ruta_al_manual.pdf" target="_blank" class="btn btn-primary">Descargar Manual (PDF)</a>
            <br>
            <hr>
            <button class="btn btn-secondary" onclick="history.back()">Atrás</button>

        </div>
    </main>


    <?php
    include("includes/footer.php");
    ?>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>