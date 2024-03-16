<?php

	require 'includes/templates/app.php';
	incluirTemplate('header');
	 
 ?>

	<main class="contenedor seccion"> 
		<h1>Contacto</h1>

		<picture>
					<source srcset="build/img/destacada3.webp" type="image/webp">
					<source srcset="build/img/destacada3.jpg" type="image/jpeg">
					<img loading="lazy" src="build/img/destacada3.jpg" alt="Texto Entrada Blog">

		</picture>

		<h2>Llene el Formulario de contacto</h2>

		<form class="formulario" method="post">
			
			<fieldset>
				 <legend>Informacion Personal</legend>

				 <label for="nombre">Nombre: </label>
				 <input type="text" id="nombre" name ="nombre" placeholder="Tu nombre">

				 <label for="email">E-Mail: </label>
				 <input type="email" id="email" name ="email" placeholder="Tu email">

				 <label for="telefono">Telefono: </label>
				 <input type="tel" id="telefono" name ="telefono" placeholder="Tu telefono">

				 <label for="mensaje">Mensaje:</label>
				 <textarea id="mensaje"></textarea>

			</fieldset>


			<fieldset>
				 <legend>Informacion sobre la propiedad</legend>

				 <label for="opciones">Vende o Compra: </label>
				 <select id="opciones" name="opciones">

				 	<option value="" disabled selected>--Seleccione --</option>
				 	<option value="Compra">Compra</option>
				 	<option value="Vende">Vende</option>

				 </select>	

				 <label for="presupuesto">Presupuesto: </label>
				 <input type="number" id="tu precio o presupuesto" name ="tu precio o presupuesto"placeholder="presupuesto">

			</fieldset>


			<fieldset>
				 <legend>Informacion sobre la propiedad</legend>

				 <p>¿Como desea ser contactado?</p>

				 <div class="forma-contacto">
				 	<label for="contactar-telefono"> Telefono</label>
				 	<input name="contacto" type="radio" value="telefono" id="contactar-telefono" name="contactar-telefono">

				 	<label for="contactar-email">Email</label>
				 	<input name="contacto" type="radio" value="email" id="contactar-email" name="contactar-email">
				 </div>

				 <label for="opciones">Vende o Compra: </label>
				 <select id="opciones" name="opciones">

				 	<option value="" disabled selected>--Seleccione --</option>
				 	<option value="Compra">Compra</option>
				 	<option value="Vende">Vende</option>

				 </select>	

				 <p>Si eligio telefono, elija la fecha y la hora para ser contactado</p>

				 <label for="fecha"> Fecha </label>
				 <input type="date">

				<label for="hora"> Hora </label>
				 <input type="time" id="hora" name="hora" min="09:00" max="18:00">


			</fieldset>


		<input type="submit" value="enviar" class="boton-verde">

		</form>

	</main>

<?php

	include './includes/templates/footer.php';
	 
 ?>
	