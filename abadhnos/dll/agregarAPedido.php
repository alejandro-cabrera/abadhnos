<?php
session_start();
include("../dll/config.php");
include("../dll/class_mysqli.php");
	    
$conexion= new clase_mysqli();
$conexion->conectar(DBHOST, DBUSER, DBPASS, DBNAME);

if(isset($_POST["añadir"])){
    if(isset($_SESSION["pedido"])){
        $item_id = array_column($_SESSION["pedido"], "item_id");
        if(!in_array($_POST["id"], $item_id)){
            $posicion = count($_SESSION["pedido"]);
            $item = array (
                'item_id'  => $_POST["id"],
                'item_nombre'  => $_POST["nombre"],
                'item_precio'  => $_POST["precio"],
            );
            $_SESSION["pedido"][$posicion] = $item;  
        }
    }else{
        $item = array (
            'item_id'  => $_POST["id"],
            'item_nombre'  => $_POST["nombre"],
            'item_precio'  => $_POST["precio"],
        );
        $_SESSION["pedido"][0]= $item; 
    }
}
        
?>