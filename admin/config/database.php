<?php 
		
	

	function conectarDB(){
		$db = new mysqli('localhost', 'root', 'Root.209', 'bienesraices_crud');

		if(!$db) {
			echo "Conexión Fallida";
			exit;
		} 

		return $db;
	}
 ?>	