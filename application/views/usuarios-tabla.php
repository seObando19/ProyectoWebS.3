<!DOCTYPE html>
<html>
<head>
	<title>Listado de usuarios</title>
</head>
<body>
	<h1><?php echo $titulo;?></h1>
	<table>
		<thead>
			<tr>
				<th>nombres</th>
				<th>correo</th>
				<th>telefono</th>
				<th>perfil</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($listado as $fila) {?>
			<tr>
				<td><?php echo $fila["nombre"]; ?></td>
				<td><?php echo $fila["correo"]; ?></td>
				<td><?php echo $fila["telefono"]; ?></td>
				<td><?php echo $fila["perfil"]; ?></td>
			</tr>
			<?php } ?>			
		</tbody>
	</table>

</body>
</html>