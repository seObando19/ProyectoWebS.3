<?php 
/*
este mismo formulario nos sirve para ingresar y modificar 
la direrencia radica que si se detecta el id quiere decir que estamos 
en un proceso de modificacion y debemos hacer los siguientes cambios

1-validar si isset id
2-traer los datos del registro
3-cambiar el form_open para que lo envie a editar
4-cambiar el boto  submit
5-agregele a cada campo el value
6-Como estamos modificando el campo clave como esta en sha1 no se */
$form_open='usuarios/nuevo';
$txtboton="Ingresar nuevo registro";
$nombre="";
$correo="";
$telefono="";
$clave="";
$perfil="";
if(isset($param))
{
	$nombre=$registro[0]["nombre"];
	$correo=$registro[0]["correo"];
	$telefono=$registro[0]["telefono"];
	$clave=$registro[0]["clave"];
	$perfil=$registro[0]["perfil"];
	$form_open='usuarios/editar/'.$param;
	$txtboton="modificar este registro";
}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Principal del sistema</title>
</head>
<body>
	<h1><?php echo $titulo; ?></h1>

<a href="<?php echo site_url('usuarios') ?>" title="Click para regresar"><strong>Regresar</strong></a>
<?php if(isset($mensaje)) echo "<h4>". $mensaje."</h4>" ?>
<br>
	<?php echo form_open($form_open); ?>
	<strong>Nombre</strong>
	<br>
	<input autocomplete="off" type="text" value="<?php echo $nombre; ?>" name="nombre" id="nombre" required size="50" maxlength="100">
	<br>
	<strong>Correo electronico</strong>
	<br>
	<input autocomplete="off" type="email" value="<?php echo $correo; ?>" name="correo" id="correo" required size="50" maxlength="255">
	<br>
	<strong>Telefono</strong>
	<br>
	<input autocomplete="off" type="number" value="<?php echo $telefono; ?>" name="telefono" id="telefono" required size="50" maxlength="15">
	<br>
	<strong>Clave</strong>
	<br>
	<?php 
		if(isset($param))
		{

			echo "*****";
		}else{	
	 ?>
	<input autocomplete="off" type="password" value="<?php echo $clave; ?>" name="clave" id="clave" required size="50" maxlength="15">
	<?php } ?>
	<br>
	<strong>Perfil</strong>
	<br>
	<select name="perfil" id="perfil" required>
		<option value="1" <?php if($perfil==1) echo "selected"; ?> >Administrador</option>
		<option value="2" <?php if($perfil==2) echo "selected"; ?> >Usuario</option>
	</select>
	<br>
	<button type="submit" name="enviar" id="enviar"><?php echo $txtboton; ?></button>
</form>	
</body>
</html>