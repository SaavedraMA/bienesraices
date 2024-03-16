	<?php

	require 'includes/templates/app.php';
	incluirTemplate('header');

	$db = conectarDB();

	$id = $_GET['id'];

	if (!$id){
		header('Location: index.php');
	}

	//Consultar 
	$query = "SELECT * FROM propiedades WHERE id = ${id}";

	$resultado = mysqli_query($db,$query);

	if (!$resultado->num_rows){
		header('Location:index.php');
	}

	$propiedad = mysqli_fetch_assoc($resultado)

 ?>

	<main class="contenedor seccion contenido-centrado">
		<h1><?php echo $propiedad['titulo']; ?></h1> 

		<picture> 					
			<img loading="lazy" src="imagenes/<?php echo $propiedad['imagen']. '.jpg'; ?>" alt="Imagen de la Propiedad">
		</picture>	

		<div class="resumen-propiedad">
			<p class="precio"> $<?php echo $propiedad['precio']; ?></p>
			<ul class ="iconos-caracteristicas">
						<li> 
							<img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono wc">
							<p><?php echo $propiedad['wc']; ?></p>
						</li>
						<li> 
							<img class ="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
							<p><?php echo $propiedad['estacionamiento']; ?></p>
						</li>
						<li> 
							<img class ="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
							<p><?php echo $propiedad['habitaciones']; ?></p>
						</li>
			</ul>


			<p> <?php echo $propiedad['descripcion']; ?> </p>



		</div>
	</main>

	
<?php

	mysqli_close($db);
	include './includes/templates/footer.php';
	 
 ?>