<html>
  <head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/aplicacion.css">
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
          <form id="barra-busqueda" method="post" action=".">
            <div id="select-menu">
              <select name="filtro" id="">
                <option value="none" selected disabled hidden>Filtro</option>
                <option value="nombreComercial">Nombre comercial</option>
                <option value="nombreFarm">Nombre farmaceutico</option>
                <option value="categoria">Categoria</option>
                <option value="productor">Productor</option>
              </select>
              <span class="flecha"></span>
            </div>
            <input type="text" name="keywords">
            <input type="submit">    
          </form>

          <?php 
			$filtro=$_POST['filtro'];
			$keywords=$_POST['keywords'];
			echo($filtro);
			echo($keywords);

          	$conexion->consulta("SELECT * FROM productos WHERE $filtro='$keywords'");
          	$conexion->verconsulta();

          	echo("<p>Resultados: </p>".$conexion->numregistros());
          ?>
        </section>
        <section id="pedido">
          
        </section>
        <section id="pedidos-activos">
          
        </section>
      </div>
    </section>
  </div>
    
  </body>
</html>