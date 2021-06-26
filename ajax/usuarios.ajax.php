<?php
//como se esta trabajando con ajax tenemos que requerir al controlador y al modelo por que es como trabajar en un segindo plano
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idUsuario;//recoger en una propiedad publica el idUsuario que enviara javascrip

	public function ajaxEditarUsuario(){#recoger ese id
		//solicitar al modelo que me muestre los usuarios
		$item = "id_usuario";//evaluarioa cualme conside con id = idusuario;
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		//deberiamos enviar un echo pero codificado en jason
		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	public $activarUsuario;
	public $activarId;


	public function ajaxActivarUsuario(){

		$tabla = "usuarios";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id_usuario";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO(parano tener 2 usuarios iguales)
	=============================================*/	

	public $validarUsuario; //hscemos la varible publica

	public function ajaxValidarUsuario(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idUsuario"])){

	$editar = new AjaxUsuarios();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> ajaxEditarUsuario();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
OBJETO PARA VALIDAR NO REPETIR USUARIO(parano tener 2 usuarios iguales)
=============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios(); //ALMACENAMOS LA CLASE
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];//RELACIONAMOS LA VARIABLE PUBLICACON LA VARIABLE POST
	$valUsuario -> ajaxValidarUsuario();//EJECUTAMOS ajaxValidarUsuario()

}