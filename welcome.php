<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>
<?php
include("includes/navbar.php");
include("includes/footer.php");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <meta name="theme-color" content="#7952b3">
    <style>
        #icon{
            font-size: 80px;
            color: blue;
            text-decoration: none;
        }
        #icon:hover{
            color: lightskyblue;
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        body {
    background: linear-gradient(90deg, rgb(206 218 221) 0%, rgb(229 229 229) 50%);
}
    </style>
</head>
<body>
    <main>
        <h1 class="visually-hidden"></h1>
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom">Bienvenido a SAREJ</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    <div class="feature-icon">
                        <a  id="icon" href="documentacion.php" class="fas fa-eye"></a>
                    </div>
                    <h2>Documentacíon</h2>
                </div>
                <div class="feature col">
                    <div class="feature-icon">
                    <a  id="icon" href="people.php" class="fas fa-user-friends"></a>
                    </div>
                    <h2 >Personas</h2>
                    </a>
                </div>
                <div class="feature col">
                    <div class="feature-icon">
                    <a  id="icon" href="registrar.php" class="far fa-user-circle"></a>
                    </div>
                    <h2>Crear cuenta</h2>
                    </a>
                </div>
            </div>
        </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>