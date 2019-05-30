<?php 
    //vista pedidos
 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $modulo ?>|<?php echo $descripcion ?></title>
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
<?php 
    $atributos=array("id"=>"formapedidos","name"=>"formapedidos");
    echo form_open('pedidos/agregar/', $atributos); 
?>

                            <div id="example-basic">                                
                                <section>
                                    <h3 class="product-cart-dn">Shopping</h3>
                                    <div class="product-list-cart">
                                        <div class="product-status-wrap border-pdt-ct">
                                            <table id="tabla-pedidos">
                                                <thead>
                                                    <tr>
                                                        <th>Numero</th>
                                                        <th>Fecha</th>
                                                        <th>Nombre</th>
                                                        <th>Telefono</th>
                                                        <th>Correo</th>
                                                        <th>Unidades</th>
                                                        <th>Total</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=0;
                                                    foreach ($lista as $fila) {
                                                        $i++;                                                
                                                     ?>
                                                    <tr>
                                                        <td style="color: #000 !important;"><?php echo $fila["pkid"]; ?> </td>
                                                        <td style="color: #000 !important;"><?php echo $fila["fecha"]; ?> </td>
                                                        <td style="color: #000 !important;"><?php echo $fila["nombre"]; ?> </td>
                                                        <td style="color: #000 !important;"><?php echo $fila["telefono"]; ?> </td>
                                                        <td style="color: #000 !important;"><?php echo $fila["correo"]; ?> </td>
                                                        <td style="color: #000 !important;"><?php echo $fila["unidades"]; ?> </td> 
                                                        <td style="color: #000 !important;"><?php echo number_format($fila["total"],0);?> </td>                                      
                                                        <td>
                                                            <a href="<?php echo site_url('pedidos/editar/'.$fila["pkid"])?>" 
                                                            data-toggle="tooltip" title="Adicionar">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true">Editar</i>
                                                            </a>

                                                            <a href="<?php echo site_url('pedidos/eliminar'.$fila["pkid"])?>"            data-toggle="tooltip" title="Eliminar" class="pd-setting-ed">
                                                                <i class="fa fa-trash-o" aria-hidden="true">Eliminar</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>    
                                            </table>        


                                        </div>
                                    </div>
                                </section>
        </div>
</form>
    <?php    
    include("incluidos/footer.php");
     ?> 
        </div>

   <?php include("incluidos/js.php");?>
</body>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
    $('#tabla-pedidos').DataTable();
} );</script>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>

<!-- 
    RTL version
-->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.rtl.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.rtl.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.rtl.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.rtl.min.css"/>
<script type="text/javascript">
    $(" .pd-setting-ed").click(function(evento){
        evento.preventDefault();
        //capturar el href para enviarlo cuando le da confirmar
        ruta=$(this).attr("href");
        alertify.confirm("Esta segur(a) de eliminar el pedido?",
            function(){
                $(location).attr("href",ruta);
            },
            function(){
                alertify.error("El proceso fue cancelado");
            }
            );
    });
</script>
</html>
