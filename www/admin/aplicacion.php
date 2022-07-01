<html>
  <head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/aplicacion.css">
  <script src="../dll/aplicacion.js" defer></script>
  </head>
  <body>
  	<?php
  		session_start();
      include("../dll/config.php");
      include("../dll/class_mysqli.php");
      $conexion= new clase_mysqli();
      $conexion->conectar(DBHOST, DBUSER, DBPASS, DBNAME);
  	?>

  <div id="contenedor">
    <header id="header" class="flex-col">
      
      <div id="logo" class="flex-col">
        <img src="https://abadhnos.com/logopeq.bmp">
        <p>Abad Hnos
      </div>
      
      <div id="username">
        Bienvenido/a <br>
        <?php echo($_SESSION['nombreUser']) ?>
      </div>
      
      <nav id="nav-principal" class="flex-col">
        <a href="#">Pedidos</a>
        <a href="#">Facturas Electrónicas</a>
        <a href="#">Cerrar sesión</a>
      </nav>  
    </header>
    
    <section id="aplicacion">
      <div id="titulo">
        
      </div>
      <nav id="nav-secundario" class="flex-col">
        <a href="#">Búsqueda de productos</a>
        <a href="#">Pedido actual / cotización</a>
        <a href="#">Pedidos en curso</a>
      </nav>
      <div id="contenido" class="flex-col">
        <section id="busqueda" class="flex-col">
          <form id="barra-busqueda" onsubmit="return fetchgo()">
            <div id="select-menu">
              <select name="filtro" id="filtro">
                <option value="none" selected disabled hidden>Filtro</option>
                <option value="nombreComercial">Nombre comercial</option>
                <option value="nombreFarm">Nombre farmaceutico</option>
                <option value="categoria">Categoria</option>
                <option value="productor">Productor</option>
              </select>
              <span class="flecha"></span>
            </div>
            <input type="text" name="keywords" id="keywords">
            <input type="submit" id="buscar">    
          </form>
          <p id="mensaje-busqueda" visible="true">
            Para buscar y agregar productos utiliza la barra de búsqueda
          </p>

          <div id="resultado" visible="false"></div>
          
        </section>
        <section id="pedido">
          <p id="mensaje-pedido" visible="true">
            Aún no tienes agregado ningún producto a tu pedido
          </p>
          <table border=1 class='tablas' rows-container>
            <tr>
              <td></td>
              <td hidden></td>
              <td>Nombre Comercial</td>
              <td>Precio Unitario</td>
              <td>Ingrese Cantidad</td>
              <td>Descuento</td>
              <td>Precio Final</td>
            </tr>
          </table>
          <template row-template>
              <tr>
                <td><button id="btn-eliminar" onclick="quitarProducto(this)" accion="eliminar"></button></td>
                <td id="item-id" hidden></td>
                <td id="nombre-com"></td>
                <td id="precio-uni"></td>
                <td> <input id="" class="entrada-cantidad" type="text" name="cantidad"> </td>
                <td></td>
                <td></td>
              </tr>
          </template>
        </section>
        <section id="pedidos-activos">
          <button onclick="borrarPedido()"></button>
        </section>
      </div>
    </section>
  </div>
  
  </body>
</html>