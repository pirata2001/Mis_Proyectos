<?php include_once("config.php");

$correo = $_POST['txtcorreo'];

// Define una expresión regular para validar el formato de correo electrónico
$expresion_regular = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

if (preg_match($expresion_regular, $correo)) {
} else {
	echo "El correo electrónico no es válido. Por favor, ingrese un correo válido.";
}
$nombre 	= $_POST['txtnombre'];
$nombredos 	= $_POST['txtnombredos'];
$apellido 	= $_POST['txtapellido'];
$apellidodos = $_POST['txtapellidodos'];
$cedula 	= $_POST['txtcedula'];
$direccion 	= $_POST['txtdireccion'];
$telefono 	= $_POST['txttelefono'];
$estadocivil = $_POST['txtcivil'];
$fechanacimiento = $_POST['txtfnacimiento'];
$sexo	= 	$_POST['txtsexo'];
$peso	= 	$_POST['txtpeso'];
$tallacalzado	= 	$_POST['txtcalzado'];
$gradodeinstruccion	= 	$_POST['txtgrado'];
$profesion	= 	$_POST['txtprofesion'];
$discapacidad	= 	$_POST['txtdiscapacidad'];
$enfermedad	= 	$_POST['txtenfermedad'];
$poseevivienda	= 	$_POST['txtposeevivienda'];
$tipovivienda	= 	$_POST['txttipovivienda'];
mysqli_query($conn, "INSERT INTO personas(nombre,nombredos,apellido,apellidodos,cedula,direccion,telefono,correo,estadocivil,fechanacimiento,sexo,peso,tallacalzado,gradodeinstruccion,profesion,discapacidad,enfermedad,poseevivienda,tipovivienda) VALUES('$nombre','$nombredos','$apellido','$apellidodos','$cedula','$direccion','$telefono','$correo','$estadocivil','$fechanacimiento','$sexo','$peso','$tallacalzado','$gradodeinstruccion','$profesion','$discapacidad','$enfermedad','$poseevivienda','$tipovivienda')");
header("Location:people.php");
