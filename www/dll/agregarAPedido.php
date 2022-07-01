<?php
session_start();
include("../dll/config.php");
include("../dll/class_mysqli.php");
	    
$conexion= new clase_mysqli();
$conexion->conectar(DBHOST, DBUSER, DBPASS, DBNAME);


if(isset($_POST["añadir"])){
    if(isset($_SESSION["pedido"])){
        if(!array_key_exists($_POST["id"], $_SESSION["pedido"])){
            $item = array (
                'item_id'  => $_POST["id"],
                'item_nombre'  => $_POST["nombre"],
                'item_precio'  => $_POST["precio"],
            );
            $_SESSION["pedido"] += [$_POST["id"] => $item];
            if(array_key_exists($_POST["id"], $_SESSION["pedido"])){
                echo(json_encode($item));
            }
            
        } else {
            echo("ya-existente");
        }
    }else{
        $item = array (
            'item_id'  => $_POST["id"],
            'item_nombre'  => $_POST["nombre"],
            'item_precio'  => $_POST["precio"],
        );
        $_SESSION["pedido"] = array ($_POST["id"] => $item); 
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
    unset($_SESSION["pedido"][$_POST['item-id']]);
    if(!array_key_exists($_POST["item-id"], $_SESSION["pedido"]))
        {echo("item-quitado");}
}

?>