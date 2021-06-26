<?php 
require_once "conexion.php";

class ModeloCategoriaGastos{
    /*--=====================================
    CREAR CATEGORIAS
    ======================================-*/
    static public function mdlIngresarCategoriaGasto($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES (:categoria)");
        $stmt->bindParam(":categoria",$datos,PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
    }
    

    /*--=====================================
    Mostrar Categoria
    ======================================-*/
    static public function mdlMostrarCategoriaGasto($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item= :$item"); 
            $stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            }else{

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla"); 
                $stmt->execute();
                return $stmt->fetchAll();
                }
        
               
                $stmt->close();
              
                $stmt=null;
    }

    static public function mdlMostrarCategoriaGasto123($tabla){
        

                $stmt = Conexion::conectar()->prepare("SELECT categoria FROM $tabla"); 
                $stmt->execute();
                return $stmt->fetchAll();

        
               
                $stmt->close();
              
                $stmt=null;
    }


    /*--=====================================
    EDITAR CATEGORIAS
    ======================================-*/
    static public function mdlEditarCategoriaGastos($tabla,$datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id_categoriaGastos = :id_categoriaGastos");
        
        $stmt->bindParam(":categoria",$datos["categoria"],PDO::PARAM_STR);
        $stmt->bindParam(":id_categoriaGastos",$datos["id_categoriaGastos"],PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
    }
    /*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarCategoriaGastos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_categoriaGastos = :id_categoriaGastos");

		$stmt -> bindParam(":id_categoriaGastos", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

}
