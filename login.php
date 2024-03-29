<?php
	//Conexion a la base de datos 

	require 'includes/templates/app.php';

	$db = conectarDB();
	//Autenticar el usuario

	$errores = [];



	//Autenticar el usuario
	if($_SERVER['REQUEST_METHOD'] === 'POST'){


		$email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
		

		$password  = mysqli_real_escape_string($db,$_POST['password']);

		if(!$email){
			$errores[]= "El email es obligatorio";
		}

		if (!$password) {
			$errores[]= "El password es obligatorio";
			
		}

		

		if (empty($errores)){
			$query = "SELECT * FROM usuarios WHERE email = '${email}'";
			$resultado = mysqli_query($db,$query);



			if ( $resultado->num_rows){
				//revisar si el pasword es correcto
				$usuario = mysqli_fetch_assoc($resultado);

				//Verificar si el password es correcto 

				$auth = password_verify($password, $usuario['password']);

				if ($auth){

					session_start();


					//Llenar el arreglo de la sesion 
					$_SESSION['usuario'] = $usuario['email'];
					$_SESSION['login'] = 'true';
					header('Location:index.php');


				}else {
					$errores []= "El password es incorrecto";
				}

			}else {
				 $errores[]= "El usuario no existe";
			}
		}
		

	} 


	//Incluye el Header 
	incluirTemplate('header');
	 
 ?>

	<main class="contenedor seccion contenido-centrado"> 
		<h1>Iniciar Sesion</h1>

		<?php foreach ($errores as $error): ?>
			<div class="alerta error">

				<?php echo $error;?>

			 </div>

		<?php endforeach; ?>



		<form  class="formulario" method="POST" novalidate >

		<fieldset>
				 <legend>E-mail y Password</legend>

				 <label for="email">E-Mail: </label>
				 <input type="email" name="email" id="email" placeholder="Tu email"
				 required>

				 <label for="password">Password: </label>
				 <input type="password" name="password" id="email" placeholder="Tu pasword" required>

		</fieldset> 

		<input type="submit" value="Inicia Session" class="boto boton-verde" name="">
        <!-------<pre></pre> ---------->
		</form>
	</main>

<?php

	include './includes/templates/footer.php';
	 
 ?>
	