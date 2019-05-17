<!DOCTYPE html>
<html>
<head>
	<title>Principal del sistema</title>
</head>
<body>
	<h1><?php echo $titulo; ?></h1>

<a href="<?php echo site_url('principal') ?>" title="Click para regresar">Principal</a>
<a href="<?php echo site_url('usuarios/nuevo') ?>" title="Click para regresar"><strong>Nuevo registro</strong></a>

	<table width="100%" cellpadding="2" cellspacing="5" bgcolor="#00000">
		<thead>
			<tr bgcolor="#ccc">
				<th>nombres</th>
				<th>correo</th>
				<th>telefono</th>
				<th>perfil</th>
				<th>Fecha registro</th>
				<th>Fecha modificacion</th>
				<th>Opcion</th>


			</tr>
		</thead>
		<tbody>
			<?php foreach ($listado as $fila) {?>
			<tr bgcolor="#fff">
				<td><?php echo $fila["nombre"]; ?></td>
				<td><?php echo $fila["correo"]; ?></td>
				<td><?php echo $fila["telefono"]; ?></td>				
				<td><?php 
				$texto="Administrador";
				if($fila["perfil"]==2) $texto="usuario";
				echo $texto;					
				?></td>
				<td><?php echo $fila["fechaingreso"] ?></td>
				<td><?php echo $fila["fechamodificacion"] ?></td>
				<td><a href="<?php echo site_url('usuarios/editar/'.$fila["id"])?>">Modificar </a><a href="<?php echo site_url('usuarios/eliminar/'.$fila["id"])?>"> Eliminar</a></td>
			</tr>
			<?php } ?>			
		</tbody>
	</table>
</body>
</html>