<?php

	require 'includes/templates/app.php';
	IncluirTemplate('header');

 ?>

	<main class="seccion contenedor"> 
		
			<section class="seccion contenedor">
		
		<h2 class="fw-300 centrar-texto">Casas y Depas en Venta</h2>

		<?php
	
		 include 'includes/templates/anuncios.php' 
		?> <!--Contenedor de los anuncios -->

<!-- Arriba estan todos los anuncios -->

		<div class="alinear-derecha">
			<a href="index.php" class="boton-verde" >Volver </a>
			
		</div>

	</section>

		</h1>
	</main>

	
<?php

	include './includes/templates/footer.php';
	 
 ?>