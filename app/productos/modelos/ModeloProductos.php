<?php
require_once "app/core/HelperDatos.php";

class ModeloProductos
{
  public function obtenerTodos()
  {
    $miConexion=HelperDatos::obtenerConexion();
    $resultado=$miConexion->query("call obtener_productos()");
    return $resultado;
  }
  public function eliminar()
  {
      //compruebo si existe la variable
    if (isset ($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        $miConexion=HelperDatos::obtenerConexion();
        $resultado=$miConexion->query("call eliminar_producto($id)");
    }
  }
  public function guardar(){
      
      $miConexion=HelperDatos::obtenerConexion();
            $id=$_REQUEST['txtProductosId'];
            $des=$_REQUEST['txtProductosDescripcion'];
            $pre=$_REQUEST['txtProductosPrecio'];
            $fot='';
            $rubid=$_REQUEST['cboRubro'];
            //var_dump($parametros);
            //si llega un nuevo archivo enviado lo copia al servidor
            if ($_FILES['filProductosFoto']['error']==0)
            {
                $ext = substr($_FILES['filProductosFoto']['name'], strrpos($_FILES['filProductosFoto']['name'],'.'));
                $nombre=microtime();
                copy($_FILES['filProductosFoto']['tmp_name'],'static\\imgs\\'.$nombre.$ext);
                $fot=$nombre.$ext;
                //echo "<img src=\"$fot\">";
            }
            else
                $fot=$_REQUEST['hidProductosFoto'];
            
            if ($id>0)
            {
                $parametros="'$des','$fot',$id,$rubid,'$pre'";
                $resultado=$miConexion->query("call modificar_producto($parametros)");
            }
            else
            {
                $parametros="'$des','$fot',$rubid,'$pre'";
                $resultado=$miConexion->query("call insertar_producto($parametros)");
            }

  }
  public function obtenerUno()
  {
    $miConexion=HelperDatos::obtenerConexion();
    $id=$_REQUEST['id'];
    $resultado=$miConexion->query("call obtener_producto($id)");
    $registro= mysqli_fetch_array($resultado);
    return $registro;
  }
}

