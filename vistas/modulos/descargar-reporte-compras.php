<?php 
require_once "../../controladores/usuarios.controlador.php";
require_once "../../controladores/proveedores.controlador.php";
require_once "../../controladores/compras.controlador.php";


require_once "../../modelos/usuarios.modelo.php";
require_once "../../modelos/proveedores.modelo.php";
require_once "../../modelos/compras.modelo.php";



$reporte = new ControladorCompras();
$reporte->ctrDescargarCompras();

?>