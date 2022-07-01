<?php
session_start();
include("../dll/config.php");
include("../dll/class_mysqli.php");
	    
$conexion= new clase_mysqli();
$conexion->conectar(DBHOST, DBUSER, DBPASS, DBNAME);


if(isset($_POST["añadir"])){
    if(isset($_SESSION["pedido"])){
        $item_id = array_column($_SESSION["pedido"]["item"], "item_id");
        if(!in_array($_POST["id"], $item_id)){
            $posicion = count($_SESSION["pedido"]);
            $item = array (
                'item_posicion' => $posicion,
                'item_id'  => $_POST["id"],
                'item_nombre'  => $_POST["nombre"],
                'item_precio'  => $_POST["precio"],
            );
            /* $_SESSION["pedido"]["item"][$posicion] = array(
                'item_id'  => $_POST["id"],
                'item'  => $item    
            ); */
            $_SESSION["pedido"] += array('item_id' => $_POST["id"], 'item' => $item);
            if(in_array($item, $_SESSION["pedido"]["item"])){echo("respuesta");}
            
        } else {
            echo("ya-existente");
        }
    }else{
        $item = array (
            'item_posicion' => 0,
            'item_id'  => $_POST["id"],
            'item_nombre'  => $_POST["nombre"],
            'item_precio'  => $_POST["precio"],
        );
        $_SESSION["pedido"] = array(
            'item_id'  => $_POST["id"],
            'item'  => $item    
        ); 
        if(in_array($item, $_SESSION["pedido"])){echo(json_encode($item));}
    }
} 

if(isset($_POST["comprobar"])){
    if(isset($_SESSION["pedido"]) && !empty($_SESSION["pedido"])){
        echo(json_encode($_SESSION["pedido"]));
    } else {
        echo("");
    }
}

if(isset($_POST["borrar"])){
    unset($_SESSION["pedido"]);
}

if(isset($_POST["quitar"])){
    
}

?>