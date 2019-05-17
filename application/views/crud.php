<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $modulo ?>|<?php echo $descripcion ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("incluidos/css.php"); ?>
    <?php 
        foreach ($css_files as $css) {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $css?>">
            <?php
        }
     ?>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <?php echo $contenido; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php    
    include("incluidos/footer.php");
     ?> 
        </div>

   <?php include("incluidos/js.php");?>
   <?php 
        foreach ($js_files as $js) {
            ?>
            <script type="text/javascript" src="<?php echo $js?>"></script>
            <?php
        }
    ?>
</body>

</html>