<?php 

require '/var/www/html/bienesraices_inicio/bienesraices_inicio/includes/templates/funciones.php';
require '/var/www/html/bienesraices_inicio/bienesraices_inicio/includes/config/database.php';
require '/var/www/html/bienesraices_inicio/bienesraices_inicio/vendor/autoload.php';	


$db = conectarDB();

use App\Propiedad;

Propiedad::setDB($db);