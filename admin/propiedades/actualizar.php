<?php 
	require '../../includes/templates/app.php';
	use App\Propiedad;
	use Intervention\Image\ImageManager as Image; 


	//Validar la URL por ID valido
	$id = $_GET['id'];
	$id = filter_var($id, FILTER_VALIDATE_INT);

	if(!$id){
		header('Location: /admin');
	} 

	//Obtener los datos de la propiedad
	$propiedad = Propiedad::find($id);

	
	//Consultar los vendedores desde la base de datos

	$consulta = "SELECT * FROM vendedores";
	$resVendedores = mysqli_query ($db, $consulta);

	
	//Arreglo para el manejo de errores

	$errores = Propiedad::getErrores();


	if ($_SERVER['REQUEST_METHOD'] === 'POST'){

		$args = $_POST['propiedad'];

		$propiedad->sincronizar($args);

		


		//Validaciones de las entradas 

		$errores = $propiedad->validar();

		//Nombre de la imagen
		$nombreImagen = md5(uniqid(rand(),true));

		
		//subida de archivos 

		if($_FILES['propiedad']['tmp_name']['imagen']){

			$image = Image::gd()->read($_FILES['propiedad']['tmp_name']['imagen']);
			$image->resize(800,600);
			
			$propiedad->setImagen($nombreImagen);

		}



		if(empty($errores)){

			//Almacenar la imagen
			if($_FILES['propiedad']['tmp_name']['imagen']){
				$image->save(CARPETA_IMAGENES .$nombreImagen);
			}
			
			$propiedad ->guardar();
		}

	} 

	$inicio = false;
	require 'header.php';
	
 ?>

 <main class="contenedor seccion">
 	<h1>Actualizar</h1>

 	 <a href="index.php" class="boton boton-verde">Volver</a>

 	 <?php foreach($errores as $error): ?>
 	 <div class="alerta error">
 	 	<?php echo $error; ?>
 	 </div>
 	<?php endforeach; ?>

 	 <form class="formulario" method="POST"  enctype="multipart/form-data">
 	 	
 	 	<?php include '../../includes/templates/formulario_propiedades.php'; ?>

 	 	<input type="submit" value="Actualizar Propiedad" class="boton boton-verde"> 
 	 </form>

 </main>

 <main class="contenedor seccion">
 	<h1>Actualizar</h1>
 </main>


 <?php 
 		require 'footer.php';

?>