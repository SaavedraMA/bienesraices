<?php 

	require '../../includes/templates/funciones.php';
	$auth = estaAutenticado();

	if (!$auth){
		header('Location:../../index.php');
	}

	$inicio = false;
	require 'header.php';
	
 ?>

 <main class="contenedor seccion">
 	<h1> Borrar</h1>
 </main>


 <?php 
	require 'footer.php';
?>