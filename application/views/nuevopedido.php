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
        </div>
        <div class="breadcome-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <span id="mensaje_carrito" class="btn btn-info">El pedido va en:</span>
                    </div>
                </div>
            </div>
        </div>
<?php 
    $atributos=array("id"=>"formapedidos","name"=>"formapedidos");
    echo form_open('pedidos/agregar/', $atributos); 
?>

                            <div id="example-basic">                                
                                <section>
                                    <h3 class="product-cart-dn">Shopping</h3>
                                    <div class="product-list-cart">
                                        <div class="product-status-wrap border-pdt-ct">
                                            <table>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Referencia</th>
                                                    <th>Cantidad</th>
                                                    <th>Valor</th>
                                                    <th>Impuestos</th>
                                                    <th>Subtotal</th>
                                                    <th>Opciones</th>
                                                </tr>
                                                <?php
                                                    $i=0;
                                                    foreach ($listarproductos as $fila) {
                                                    $i++;                                             
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                            if ($fila["foto1"]<>"") {?>

                                                                <img src="<?php echo base_url();?>/assets/uploads/productos/<?php echo $fila["foto1"];?>"  style="width:100px">
                                                            
                                                         <?php }?>
                                                    </td>
                                                    <td>
                                                        <h3><?php echo $fila["ref"]; ?></h3>
                                                        <p><?php echo $fila["nombre"] ?></p>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="cant_<?php echo $i;  ?>" id="cant_<?php echo $i; ?>" maxlength="4" style="width: 60px" onblur="calcular('<?php echo $i ?>');">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control"  name="valor_<?php echo $i;  ?>" id="valor_<?php echo $i; ?>" value="<?php echo $fila["precio"] ?>" maxlength="10"
                                                        style="width: 100px" onblur="calcular('<?php echo $i ?>');">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control"  name="impuesto_<?php echo $i;  ?>" id="impuesto_<?php echo $i; ?>" value="<?php echo $fila["iva"] ?>" maxlength="2" style="width: 60px" onblur="calcular('<?php echo $i ?>');">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control"  name="subtotal_<?php echo $i;  ?>" id="subtotal_<?php echo $i; ?>" readonly style="width: 200px; color: #000!important">
                                                    </td>                                                    
                                                    <td>
                                                        <button onclick="agregar('<?php echo $i; ?>',1)" type="button" 
                                                        data-toggle="tooltip" title="Adicionar" class="pd-setting-ed">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </button>

                                                        <button onclick="agregar('<?php echo $i; ?>',2)" type="button"
                                                         data-toggle="tooltip" title="Trash" class="pd-setting-ed">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>

                                                        <input type="hidden" name="ref_<?php echo $i?>" id="ref_<?php echo $i?>" value="<?php echo $fila["ref"]?>">

                                                        <input type="hidden" name="token_<?php echo $i?>" id="token_<?php echo $i?>" value="<?php echo $token?>">
                                                        <span id="mensaje_<?php echo $i;?>"></span>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                         <table>
                                                <thead>
                                                        <tr>
                                                            <th colspan="3">DATOS DEL CLIENTE
                                                                <select name="cliente" id="cliente" class="form-control" onchange="cargarcliente()">
                                                                <option value="">Seleccione...</option>
                                                                <?php
                                                                    foreach ($listadoclientes as $fila ) {?>
                                                                        <option value="<?php echo $fila["pkid"];?>">
                                                                        <?php echo $fila["nombre"]." ".$fila["comercial"];?>
                                                                        </option>
                                                                    
                                                                <?php } ?>
                                                                </select>
                                                                <span id="mensaje_cliente"></span>                                                            
                                                            </th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr>
                                                            <td>
                                                                <input class="form-control" type="text" name="nit" id="nit"
                                                                placeholder="Digite el nit" maxlength="50" required >
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text" name="nombre" id="nombre"
                                                                placeholder="Digite el nombre" maxlength="50" required >
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text" name="comercial" id="comercial"
                                                                placeholder="Digite el comercial" maxlength="50" required >
                                                            </td>
                                                        </tr>
                                                        <tr>    
                                                            <td>
                                                                <input class="form-control" type="email" name="correo" id="correo"
                                                                placeholder="Digite el correo" maxlength="50" required" >
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="number" name="telefono" id="telefono"
                                                                placeholder="Digite el telefono" maxlength="50" required" >
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text" name="direccion" id="direccion"
                                                                placeholder="Digite la direccion" maxlength="255" required" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <button class="btn btn-info" name="enviar" id="enviar">GENERAR PEDIDO</button>
                                                            </td>
                                                        </tr>
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

</html>
<script type="text/javascript">
    /*
        funciones que permiten calcular el subtotal y funciones de agregar y eliminar productos del pedido 
        para el calcular tomamos la posicion
        para agregar y eliminar usamos AJAX para realizar el proceso de modo en paralelo
    */
    function calcular(pos)
    {
        //capturar los id de cant,iva,precio y sutotal para realizar operaciones
        $("#subtotal_"+pos).val(0);
        var cant=$("#cant_"+pos).val();
        var precio=$("#valor_"+pos).val();
        var iva=$("#impuesto_"+pos).val();

        if(cant>0 && precio>0 && iva>=0)
        {
            subtotal=eval(cant*precio) + (cant*precio*(iva/100));
        }
        $("#subtotal_"+pos).val(subtotal);
    }

    //funcion agregar que captura la ruta desde el action del formulario y pasamos los parametros 
    //al controlador pedidos/agregar
    // 1=que agregue
    // 2=que elimine
    //el tipo se pasa de acuerdo al funcion que se invoque en este caso. agregar sera 1 y eliminar 2

    function agregar(pos,tipo)
    {
        var ruta = $("#formapedidos").attr("action");        
        var cant=$("#cant_"+pos).val();
        var precio=$("#valor_"+pos).val();
        var iva=$("#impuesto_"+pos).val();
        var subtotal=$("#subtotal_"+pos).val();
        var ref =$("#ref_"+pos).val();
        var token =$("#token_"+pos).val();

        if(subtotal<=0)
        {
            mensaje="<span class='btn-danger'>El subtotal debe ser mayor de cero</span>"

            $("#mensaje_"+pos).html(mensaje);
            $("#mensaje_"+pos).fadeOut(5000);
            return;
        }

        //iNVOCAR LA FUNCION AJAX QUE NOS PERMITE CARGAR EL CONTROLADOR Y LA FUNCION QUE ESTA EN EL ACTION DEL FORMULARIO 
        //(pedidos/agregar)

        //procesos asincronicos -->AJAX -->url-type-data
        //tres grandes procesos:
        //1-cuando se va a enviar /BeforeSend
        //2-cuando se esta enviando  /Suceess
        //3-errores /error ->error de sintaxis o el error es por parte del servidor por que no lo dejo
        //xmlhttprequest
        //Motor de JS para utilizar 


        //1-preparar los datos para ajax
        //los datos se deben pasar como un array o vector

        parametros = {
            "cant":cant,
            "precio":precio,
            "iva":iva,
            "subtotal":subtotal,
            "ref":ref,
            "token":token,
            "tipo":tipo
        };

        //2- la ruta o la url ya esta capturada en a parte de arriba

        //3-definir el metodo de transporte post o get

        type="POST";

        //4-invocar ajax
        $.ajax({
            data : parametros,
            url : ruta,
            type : type,
            beforesend : function()
            {                
                $("#mensaje_"+pos).html("<span class='btn btn-warning'>Procesando...</span>");
                $("#mensaje_"+pos).show();
                
            },
            //el success siempre devuelve una respuesta en este caso 
            // ´por memotecnia  se llama response
            success : function(response)
            {
                $("#mensaje_"+pos).show();
                if(tipo==1) txt="agregado";
                if(tipo==2) txt="Eliminado";
                $("#mensaje_"+pos).html("<span class='btn btn-success'>"+txt+"</span>");
                $("#mensaje_"+pos).fadeOut(5000);

                $("#mensaje_carrito").html(response);
            },
            //cacturar el error y mostar en la capa mensaje
            error : function(jqXHR,textStatus,errorThrown)
            {                              
                    
                    $("#mensaje_"+pos).html("<span class='btn btn-warning'>Error al procesar:"+textStatus+","+errorThrown+"</span>");
                    $("#mensaje_"+pos).show();
                
            }
        });

    }
    //funcion que envia el id del cliente, consulta y devuelve los datos en formato JSON
    function cargarcliente() {
        var ruta = $("#formapedidos").attr("action");
        ruta=ruta.replace("agregar","cargarcliente");
        parametros=
        {
            "cliente" : $("#cliente").val()
        }
        $.ajax({
            data : parametros,
            type : "POST",
            url : ruta,
            beforesend : function() {                
                $("#mensaje_cliente"+pos).show();
                $("#mensaje_cliente"+pos).html("<span class='btn btn-warning'>Procesando...</span>");
            },
            success : function(response) {
                $("#mensaje_cliente").hide();
                //aplicar parse para leer un vector o array en JSON
                data=JSON.parse(response);
                $("#nombre").val(data[0].nombre);
                $("#comercial").val(data[0].comercial);
                $("#telefono").val(data[0].telefono);
                $("#direccion").val(data[0].direccion);
                $("#nit").val(data[0].nit);
            },
            error : function(jqXHR,textStatus,errorThrown) {
                $("#mensaje_cliente"+pos).html("<span class='btn btn-warning'>Error al procesar:"+textStatus+","+errorThrown+"</span>");
                    $("#mensaje_cliente"+pos).show();
            }
        });     
    }
</script>