<?php
include("includes/footer.php");
?>
<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}
require_once "config.php";
$username = $password = "";
$username_err = $password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese su usuario.";
    } else {
        $username = trim($_POST["username"]);
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingrese su contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            header("location: welcome.php");
                        } else {
                            $password_err = "La contraseña que has ingresado no es válida.";
                        }
                    }
                } else {
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else {
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
<!doctype html>
<html lang="es">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>SAREJ</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <meta name="theme-color" content="#7952b3">
    <style>
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
            background: #f0f0f0;
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>

</head>

<body>

    <div class="container col-xl-19 col-xxl-10 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-3 text-center text-lg-start">

                </p>
            </div>
            <div class="col-lg-6 text-center ">
                <img src="img/logoconsejo.png" class="img-fluid rounded-top" alt="" width="50px">
                <p class="fw-light fs-4">Consejo Comunal Sabana Larga</p>

            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group1 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Usuario" maxlength="15" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                            <label for="floatingInput">Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <div class="form-group2 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" name="password" maxlength="15">
                                <span class="help-block"><?php echo $password_err; ?></span>
                                <br>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary">Iniciar Sesión</button>
                            <hr class="my-4">

                </form>

            </div>

        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>