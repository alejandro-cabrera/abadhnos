<?php

//variables de sesion
session_start();	//levantar la variable de sesion
if (($_POST['usuario']) && ($_POST['clave'])) {
	$usuario=$_POST['usuario'];
//	$clave=md5($_POST['clave']);
	$clave=$_POST['clave'];

	include("config.php");
	include("class_mysqli.php");

	$conexion= new clase_mysqli();
	$conexion->conectar(DBHOST, DBUSER, DBPASS, DBNAME);
	$conexion->consulta("SELECT * FROM usuarios where usuario='$usuario' and clave='$clave'");	//validacion de credenciales
	$listaUser=$conexion->consulta_lista();
	
	if (@$listaUser[0]) {	//si la validacion tuvo exito, $listaUser[0] debe contener el nombre de usuario sacado de la BD,
							//si no tuvo exito,  $listaUser[0] debe estar vacia y pasara como false en el if

		//crear las variables de sesion
		$_SESSION['autentificado']=TRUE;
		$_SESSION['idUser']=$listaUser[0];
		$_SESSION['nombreUser']=$listaUser[1];
		$_SESSION['localPath']=$local_path;

		echo "<script>location.href='../admin/aplicacion.php'</script>";
	}else{
		echo '<script>alert("Datos incorrectos..");</script>';
		echo "<script>location.href='../login.html'</script>";
	}

}else{
	echo '<script>alert("Datos faltantes..");</script>';
	echo "<script>location.href='../login.html'</script>";
}
?>