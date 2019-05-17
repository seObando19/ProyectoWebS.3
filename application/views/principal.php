<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bienvenidos Principal del sistema</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("incluidos/css.php"); ?>
</head>

<body>
    <?php 
    include("incluidos/aside.php");
    ?>
        <div class="all-content-wrapper">
    <?php
    include("incluidos/menu.php");
    include("incluidos/menu.movil.php");
    include("incluidos/menu.movil.fin.php");
    ?>
        </div>
    <?php
    include("incluidos/resumen.php");
    include("incluidos/graficas.php");
    include("incluidos/trafico.php");
    include("incluidos/productos.php");
    include("incluidos/ventas.php");
    include("incluidos/calendario.php");
     ?> 
        </div>

   <?php include("incluidos/js.php");?>
</body>

</html>