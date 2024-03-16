<?php 
namespace App;

class ActiveRecord {
	/// Base de datos
	protected static $db;
	protected static $columnasDB = ['id','titulo', 'precio', 'imagen','descripcion', 'habitaciones', 'wc','estacionamiento', 'creado','vendedorId' ];

	protected static $tabla = '';

	//Errores
	protected static $errores = [];


	public $id;
	public $titulo;
	public $precio;
	public $imagen;
	public $descripcion;
	public $habitaciones;
	public $wc;
	public $estacionamiento;
	public $creado;
	public $vendedorId;

	public static function setDB($database)
	{
		self::$db =$database;
	}

	public function __construct($args = [])
	{
		$this->id = $args['id']?? null;
		$this->titulo = $args['titulo']?? '';
		$this->precio = $args['precio']?? '';
		$this->imagen = $args['imagen']?? '';
		$this->descripcion = $args['descripcion']?? '';
		$this->habitaciones = $args['habitaciones']?? '';
		$this->wc = $args['wc']?? '';
		$this->estacionamiento = $args['estacionamiento']?? '';
		$this->creado = date('y/m/d');
		$this->vendedorId = $args['vendedorId']?? '1';

	}

	public function guardar(){

		if(!is_null($this->id)){
			//Actualizar
			$this->actualizar();
		} else {
			// Creando un nuevo registro
			$this->crear();	
		}
	}

public function actualizar(){

		$atributos = $this->sanitizarAtributos();
		
		$valores = [];

		foreach ($atributos as $key => $value) {
			$valores []= "{$key} ='{$value}'";
		}

		$query = " UPDATE ". static::$tabla. " SET ";
		$query .= join(', ', $valores );
		$query.=  " WHERE id = '" .self::$db->escape_string($this->id)."' ";
		$query .= " LIMIT 1 "; 


		$resultado = self::$db->query($query);


		if ($resultado){
			//redirecion al usuario
			header('Location:index.php?resultado=2');			
		} 

	}

public function eliminar(){
	// ELiminar la propiedad
	$query = "DELETE FROM ". static::$tabla. " where id = " . self::$db->escape_string($this->id)." LIMIT 1 ";
	$resultado= self::$db->query($query);

	if ($resultado){
		$this->borrarImagen();
		header('Location: index.php?resultado=3');
	}
}


public function crear(){

		//Sanitizar los datos 
		$atributos = $this->sanitizarAtributos();
		//Quuery para insertar en la base de datos 

		$query = " INSERT INTO" . static::$tabla "( ";
        $query .= join(', ', array_keys($atributos)); 
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

		$resultado = self::$db->query($query);

		//Mensaje de Exito o Error 
		if ($resultado){
			//redirecion al usuario
			header('Location:index.php?resultado=1');
			
		}
}



//Identificar y unir los atributos a la DB
public function atributos(){
	$atributos=[];

	foreach (self::$columnasDB as $columna) {
		if($columna === 'id') continue;
		$atributos[$columna] = $this->$columna;
	}

	return $atributos;
}	



	public function sanitizarAtributos(){

		$atributos = $this->atributos();

		$sanitizado = [];

		foreach($atributos as $key => $value) {
			$sanitizado[$key] = self::$db->escape_string($value);

		}

		return $sanitizado;
	}



	//Subida de archivos 	

	public function setImagen($imagen){
		

		//Elimina la imagen anterior 
		if(!is_null($this->id)){
			$this->borrarImagen();
		}
		
		//Asignar al atributo imagen el nombre de la imagen 
		if($imagen){
			$this->imagen = $imagen;
		}
		
	}


	//Elimina el archivo 

	public function borrarImagen(){
		$existeArchivo= file_exists(CARPETA_IMAGENES.$this->imagen);

		if($existeArchivo){
			unlink(CARPETA_IMAGENES.$this->imagen);
		}
	}

	//Validacion 
	public static function getErrores(){
		return self::$errores;
	}

	public function validar(){
		if(!$this->titulo){
			self::$errores [] = "Debes añadir un titulo"; 
		}

		if(!$this->precio){
			self::$errores [] = "El precio es obligatorio"; 
		}

		if(strlen($this->descripcion) < 50){
			self::$errores [] = "La descripcion es obligatoria y debe tener al menos 50 caracteres"; 
		}
		

		if(!$this->habitaciones){
			self::$errores [] = "El numero de habitaciones es obligatorio"; 
		}

		if(!$this->wc){
			self::$errores [] = "El numero de wc es obligatorio"; 
		}

		if(!$this->estacionamiento){
			self::$errores [] = "El numero de estacionamientos es obligatorio"; 
		}
		if(!$this->vendedorId){
			self::$errores [] = "Elige un vendedor"; 
		}

		if(!$this->imagen) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }
		//validar por tamaño (1 mb) 

		return self::$errores;

	}

	//Lista de las ". static::$tabla. "

	public static function all(){
		$query = "SELECT * FROM ". static::$tabla;

		$resultado = self::consultarSQL($query);

		return $resultado;	
	}

	public static function find($id){
		$query ="SELECT * FROM propiedades WHERE id= ${id}";

		$resultado = self::consultarSQL($query);

		return array_shift($resultado);
	} 


	public static function consultarSQL($query){
		//Consultar la base de datos 
		$resultado= self::$db->query($query);

		//Iterar los datos 
		$array = [];

		while ($registro = $resultado->fetch_assoc()){

			$array[] = self::crearObjeto($registro);

		}

		// Liberar la memoria 

		$resultado->free();

		//Retornar los resultados 
		return $array;
	}


		protected static function crearObjeto($registro){

		$objeto = new self;

		foreach ($registro as $key => $value) {
			if(property_exists($objeto,$key)){
				$objeto->$key = $value;

			}
		}

		return $objeto;

	}

	//Sincroniza el objeto en memoria con los cambios realizados por el usuario 

	public function sincronizar($args = []){

		foreach ($args as $key => $value) {
		 	if(property_exists($this,$key) && !is_null($value)){
		 		$this->$key = $value;
		 	}
		 }

	}
}