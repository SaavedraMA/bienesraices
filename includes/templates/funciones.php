<?php 

define ('TEMPLATES_URL', __DIR__ );
define ('FUNCIONES_URL',__DIR__ . 'funciones.php'); 
define ('CARPETA_IMAGENES', __DIR__.'/../../imagenes/' );




function IncluirTemplate ( string $nombre, bool $inicio = false){
	include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(){
		session_start();

		if (!$_SESSION['login']){
			header('Location: ../../index.php');
		} 
}

function debugear($variable){
	echo "<pre>";
	var_dump($variable);
	echo "</pre>";
	exit;
}

//Escapa / Sanitizar el HTML 

function s($html){
	$s = htmlspecialchars($html??'');
	return $s;
}