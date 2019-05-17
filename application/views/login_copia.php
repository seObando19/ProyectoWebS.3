<!DOCTYPE html>
<html>
<head>
	<title>Acceso al sistema</title>	
</head>
<body>
	<h1>Ingrese login y clave</h1>
<?php echo form_open('login/acceso/') ?>
		<strong>Usuario:</strong>
		<br>
		<input type="email" name="correo" id="correo"placeholder="digite correo" required maxlength="100">
		<br>
		Clave:
		<br>
		<input type="password" name="clave" id="clave" placeholder="digite clave" required maxlength="20">
		<br>
		<button type="submit" name="enviar" id="enviar">Acceder al sistema</button>
</form>

</body>
</html>