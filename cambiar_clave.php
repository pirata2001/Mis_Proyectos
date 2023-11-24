<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
require_once "config.php";
$current_password = $new_password = $confirm_new_password = "";
$current_password_err = $new_password_err = $confirm_new_password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["current_password"]))) {
        $current_password_err = "Por favor ingresa tu contraseña actual.";
    } else {
        $current_password = trim($_POST["current_password"]);
    }
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Por favor ingresa una nueva contraseña.";
    } elseif (strlen(trim($_POST["new_password"])) < 8) {
        $new_password_err = "La contraseña debe tener al menos 8 caracteres.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }
    if (empty(trim($_POST["confirm_new_password"]))) {
        $confirm_new_password_err = "Confirma tu nueva contraseña.";
    } else {
        $confirm_new_password = trim($_POST["confirm_new_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_new_password)) {
            $confirm_new_password_err = "Las contraseñas no coinciden.";
        }
    }
    if (empty($current_password_err) && empty($new_password_err) && empty($confirm_new_password_err)) {
        $sql = "SELECT password FROM users WHERE id = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $_SESSION["id"];
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($current_password, $hashed_password)) {
                            $sql = "UPDATE users SET password = ? WHERE id = ?";
                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
                                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                                if (mysqli_stmt_execute($stmt)) {
                                    session_destroy();
                                    header("location: index.php");
                                    exit();
                                } else {
                                    echo "Algo salió mal, por favor inténtalo de nuevo.";
                                }
                            }
                            mysqli_stmt_close($stmt);
                        } else {
                            $current_password_err = "La contraseña actual no es válida.";
                        }
                    }
                } else {
                    echo "Algo salió mal, por favor inténtalo de nuevo.";
                }
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style type="text/css">
        .wrapper {
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
    <div class="wrapper">
        <h2>Cambiar Contraseña</h2>
        <p>Por favor complete este formulario para cambiar su contraseña.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="col-md-3 <?php echo (!empty($current_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="current_password" placeholder="Contraseña Actual" class="form-control" value="<?php echo $current_password; ?>">
                <span class="help-block"><?php echo $current_password_err; ?></span>
            </div>
            <br>
            <div class="col-md-3 <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="new_password" placeholder="Nueva Contraseña" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="col-md-3 <?php echo (!empty($confirm_new_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_new_password" placeholder="Confirmar Nueva Contraseña" class="form-control" value="<?php echo $confirm_new_password; ?>">
                <span class="help-block"><?php echo $confirm_new_password_err; ?></span>
            </div>
            <br>
            <div class="col-md-3">
                <input type="submit" class="btn btn-primary" value="Cambiar Contraseña">
                <a class="btn btn-danger" href="welcome.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>