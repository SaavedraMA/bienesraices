<?php 
	require '../../includes/templates/app.php';

	use App\Propiedad;
	use Intervention\Image\ImageManager as Image; 

/////////////////////////////////////////////////
 	estaAutenticado();

	$db = conectarDB();

	$propiedad = new Propiedad;

	//Consultar los vendedores desde la base de datos

	$consulta = "SELECT * FROM vendedores";
	$resVendedores = mysqli_query ($db, $consulta);

	//Arreglo para el manejo de errores

	$errores=Propiedad::getErrores();


	//Inicializacion de las variables 

	$titulo = '';
	$precio = '';
	$imagen = '';
	$descripcion = '';
	$habitaciones = '';
	$wc = '';
	$estacionamiento = '';
	$vendedorId = '';

	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		

		//** Crea una nueva instacia
		$propiedad = new Propiedad($_POST['propiedad']);

		//Crear nombre aleatorio y unico

		$nombreImagen = md5(uniqid(rand(),true)).".jpg";

		//Setear la imagen 
		//Realiza un resize a la imagen con intervetion 
		if($_FILES['propiedad']['tmp_name']['imagen']){
			$image = Image::gd()->read($_FILES['propiedad']['tmp_name']['imagen']);
			$image->resize(800,600);
			
			$propiedad->setImagen($nombreImagen);
		}
		
		//Validar 
		$errores = $propiedad->validar();

		
		if(empty($errores)){

			//Crear la carpeta para subir imagenes
			if (!is_dir(CARPETA_IMAGENES)){
			mkdir(CARPETA_IMAGENES);
			}

			// Guarda la imagen en el server
			$image->save(CARPETA_IMAGENES .$nombreImagen); 
			
			$propiedad->guardar();
		}	

	} 

	$inicio = false;
 	require 'header.php';
	
 ?>

 <main class="contenedor seccion">
 	<h1>Crear</h1>

 	 <a href="index.php" class="boton boton-verde">Volver</a>

 	 <?php foreach($errores as $error): ?>
 	 <div class="alerta error">
 	 	<?php echo $error; ?>
 	 </div>
 	<?php endforeach; ?>

 	 <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">
 	 	<?php include '../../includes/templates/formulario_propiedades.php'; ?>	

 	 	<input type="submit" value="Crear Propiedad" class="boton boton-verde"> 
 	 </form>

 </main>


  <?php 

 	require 'footer.php';

  ?>