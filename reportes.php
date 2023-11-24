
<?php
ob_start();
?>
<?php
date_default_timezone_set('America/Mexico_City');
        $fecha_actual = getdate();
include("config.php");
$queryusuarios = mysqli_query($conn, "SELECT * FROM personas");
$codigo = $_GET['id'];
$querybuscar = mysqli_query($conn, "SELECT * FROM personas WHERE id=$codigo");;
while($mostrar = mysqli_fetch_array($querybuscar))
{
    $codigo = $mostrar['id']; 
    $nombre = $mostrar['nombre'];
    $nombredos = $mostrar['nombredos'];
	$apellido = $mostrar['apellido'];
    $apellidodos = $mostrar['apellidodos'];
    $cedula = $mostrar['cedula'];
    $direccion = $mostrar['direccion'];
    $telefono = $mostrar['telefono'];
    $correo = $mostrar['correo'];
    $estadocivil = $mostrar['estadocivil'];
	$fechanacimiento = $mostrar['fechanacimiento'];
    $sexo	= 	$mostrar['sexo'];
	$peso	= 	$mostrar['peso'];
	$tallacalzado	= 	$mostrar['tallacalzado'];
	$gradodeinstruccion	= 	$mostrar['gradodeinstruccion'];
	$profesion	= 	$mostrar['profesion'];
    $discapacidad	= 	$mostrar['discapacidad'];
    $enfermedad	= 	$mostrar['enfermedad'];
    $tipovivienda	= 	$mostrar['tipovivienda'];
}
?>
    <meta charset="UTF-8">
    
    <div class="contenido">
    <!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Constancia de Residencia</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			line-height: 1.5;
		}
		h1 {
			text-align: center;
			font-size: 24px;
			margin-bottom: 30px;
		}
        h2{
            text-align: center;
            margin-top: 300px;
        }
        h3{
            text-align: center;
            margin-top: 70px;
        }
		.row {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			margin-bottom: 10px;
		}
		label {
			font-weight: bold;
			min-width: 200px;
			margin-right: 20px;
			display: inline-block;
		}
		.info {
			flex-grow: 1;
			display: inline-block;
		}
		.firma {
			display: flex;
			flex-direction: row;
			justify-content: flex-end;
			margin-top: 30px;
		}
		.firma label {
			margin-right: 50px;
			font-weight: bold;
		}
        .encabezado{
            text-align: center;
			font-size: 16px;
        }
        .texto{
            font-size:15px;
        }
	</style>
</head>
<body>
    <p class="encabezado">REPUBLICA BOLIVARIANA DE VENEZUELA <br> CONSEJO COMUNAL “SABANA LARGA”<br>MUNICIPIO RICAURTE-ESTADO COJEDES</p>
	<br><br>
    <h1>CARTA DE RESIDENCIA</h1>
	<p class="texto">Nosotros miembros del Consejo Comunal “SABANA LARGA” por medio de la presente hacemos constar que el (la) ciudadano (a)  <?php echo "$nombre $nombredos $apellido $apellidodos";?> Titular de la Cedula de identidad   <?php echo "V-$cedula";?>, reside en  <?php echo "$direccion";?>, estado Cojedes, desde hace ___ años demostrando ser una persona responsable y cumplidora de sus obligaciones, dentro y fuera de la comunidad.</p>
    <p class="texto">Constancia que se expide a solicitud de parte interesada en “SABANA LARGA”, Municipio Ricaurte, estado Cojedes a los <?php echo $fecha_actual['mday'];?> días del mes <?php echo $fecha_actual['mon'];?> del año <?php echo $fecha_actual['year'];?></p> 
    <h2>ATENTAMENTE</h2>
    <p>Por el Consejo Comunal</p>
    <h3>VOCERO</h3>
<?php
$html=ob_get_clean();
//echo $html;
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnable'=>true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo_.pdf", array("Attachment" => false));
?>