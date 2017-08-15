<?php
require_once "app/core/HelperDatos.php";

class ModeloRubros
{
  public function obtenerTodos()
  {
    $miConexion=HelperDatos::obtenerConexion();
    $resultado=$miConexion->query("call obtener_Rubros()");
    return $resultado;
  }
  public function eliminar()
  {
      //compruebo si existe la variable
    if (isset ($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        $miConexion=HelperDatos::obtenerConexion();
        $resultado=$miConexion->query("call eliminar_rubro($id)");
    }
  }
}