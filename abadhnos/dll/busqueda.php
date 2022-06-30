<?php 
    include("../dll/config.php");
	include("../dll/class_mysqli.php");
	$conexion= new clase_mysqli();
	$conexion->conectar(DBHOST, DBUSER, DBPASS, DBNAME);

	$filtro=$_POST["filtro"];
	$keywords=$_POST['keywords'];

    $conexion->consulta("SELECT * FROM productos WHERE $filtro='$keywords'");
    $conexion->verconsultacompra();

    echo("<span>Resultados: </span>".$conexion->numregistros());
?>