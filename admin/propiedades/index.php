<?php 
	
	
	require '../../includes/templates/app.php';
	estaAutenticado();

	use App\Propiedad;

	//Implementar un metodo para obtener todas las propiedades 
	$propiedades = Propiedad::all();
	

	// Muestra mensaje condicional 
	 $resultado = $_GET['resultado'] ?? null;
	


	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$id = $_POST['id'];
		$id = filter_var($id, FILTER_VALIDATE_INT); 

		if ($id){ 

			$propiedad = Propiedad::find($id);

			$propiedad->eliminar();

		
			
		}

	}


	//Agrego el header 
	$inicio = false;
 	require 'header.php';
	
 ?>

<!DOCTYPE html>
<html>
<body>

	<main class="contenedor seccion">
 		<h1>Administrador de Bienes Raices</h1> 
 			<?php  if(intval($resultado) === 1): ?>
 				<p class="alerta exito"> Anuncio Creado Correctamente </p>
 			<?php  elseif (intval($resultado) === 2): ?>
 				<p class="alerta exito"> Anuncio Actualizado Correctamente </p>
 			<?php  elseif (intval($resultado) === 3): ?>
 				<p class="alerta exito"> Anuncio Eliminado Correctamente </p>
 			<?php endif; ?>				
 		<a href="crear.php" class="boton boton-verde">Nueva Propiedad </a>

 		<table class="propiedades">
 			<thead>
 				<tr>
 					<th>ID</th>
 					<th>Titulo</th>
 					<th>Imagen </th>
 					<th>Precio</th>
 					<th>Acciones</th>
 				</tr>
 			</thead>

 			<tbody><!---------Mostrar los resultados --------->


 				<?php foreach ($propiedades as $propiedad):?>
 				<tr>
 					<td> <?php echo $propiedad->id; ?> </td>
 					<td> <?php echo $propiedad->titulo; ?></td>
 					<td> <img src="../../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"> </td>
 					<td>$ <?php echo $propiedad->precio; ?></td>
 					<td>
 						<form method="POST"  class="w-100" >
 							<input type="hidden" name="id" value="<?php echo $propiedad->id; ?>" >
 							<input type="submit" class="boton-rojo-block" value="Eliminar">
 						</form>

 						<a href="actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
 					</td>	
 				</tr>
 				<?php endforeach;?>
 			</tbody>
 		</table>
 	</main>


</body>
</html>
 

 <?php 

 		require 'footer.php';

  ?>