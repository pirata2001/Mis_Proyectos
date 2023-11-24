<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>
<?php
require_once "config.php";
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese un usuario.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este usuario ya fue tomado.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingresa una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "La contraseña al menos debe tener 8 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Confirma tu contraseña.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "No coincide la contraseña.";
        }
    }
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            if (mysqli_stmt_execute($stmt)) {
                header("location: welcome.php");
            } else {
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="/sarej/css/bootstrap.min.css">
    <style type="text/css">
        .login-page {
            text-align: center;
        }

        .col-md-3 {
            margin-left: 37%;
        }

        .help-block {
            color: red;
        }

        h2 {
            margin-top: 3%;
        }
    </style>
</head>

<body>
    <div class="login-page">
        <h2>Crear Cuenta</h2>
        <p>Por favor complete este formulario para registrar una nueva cuenta.</p>
        <div class="form">
            <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="col-md-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <!-- <label>Usuario:</label> -->
                    <input type="text" name="username" maxlength="15" placeholder="Usuario" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <br>
                <div class="col-md-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <!-- <label>Contraseña:</label> -->
                    <input type="password" name="password" maxlength="15" placeholder="Contraseña" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="col-md-3 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <!-- <label>Confirmar Contraseña:</label> -->
                    <input type="password" name="confirm_password" maxlength="15" placeholder="Confirmar Contraseña" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"> <?php echo $confirm_password_err; ?> </span>
                </div>
                <br>
                <div class="col-md-3">
                    <button type="submit" name="button" class="btn btn-primary">Siguiente </button>
                    <a name="" id="" class="btn btn-danger" href="welcome.php" role="button">Atras</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</body>
</html>