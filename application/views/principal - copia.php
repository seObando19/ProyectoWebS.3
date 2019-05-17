<!DOCTYPE html>
<html>
<head>
	<title>Principal del sistema</title>
</head>
<body>
	<h1>Bienvenido <?php echo $nombreusuario ?></h1>
Opciones del sistema:
<br>
<br>
<a href="<?php echo site_url('usuarios') ?>" title="Click para ingresar al modulo de usuarios">Usuarios</a>
<br>
<br>
<a href="<?php echo site_url('salir') ?>" title="Click para salir del sistema">[X] Salir del sistema</a>
</body>
</html>