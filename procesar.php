<?php 

$host="localhost";
$user="root";
$pw="daftmau5";
$bd="registro";

if (isset($_POST['nombre']) && !empty ($_POST['nombre']) && isset($_POST['apellido']) && !empty ($_POST['apellido']) && isset($_POST['pw']) && !empty ($_POST['pw'])) 
{
	$conexion = mysql_connect($host,$user,$pw) or die ("problema al conectar el host");
	mysql_select_db($bd, $conexion) or die ("problemas al conectar la bd");
	mysql_query("INSERT INTO registro2 (nombre,apellido,pw) VALUES ('$_POST[nombre]','$_POST[apellido]','$_POST[pw]')",$conexion);
	echo "datos insertados correctamente";

} else{
	echo "problema al insertar los datos";
}


 ?>