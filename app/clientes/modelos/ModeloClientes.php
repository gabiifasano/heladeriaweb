<?php
require_once "app/core/HelperDatos.php";

class ModeloClientes
{
  public function obtenerTodos()
  {
    $miConexion=HelperDatos::obtenerConexion();
    $resultado=$miConexion->query("call obtener_clientes()");
    return $resultado;
  }
  public function eliminar()
  {
      //compruebo si existe la variable
    if (isset ($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        $miConexion=HelperDatos::obtenerConexion();
        $resultado=$miConexion->query("call eliminar_cliente($id)");
    }
  }
  public function guardar(){
      
      $miConexion=HelperDatos::obtenerConexion();
            $id=$_REQUEST['txtClientesId'];
            $nom=$_REQUEST['txtClientesNombre'];
            $dni=$_REQUEST['txtClientesDni'];
            $fechanac=$_REQUEST['txtClientesFechaNacimiento'];
            $tel=$_REQUEST['txtClientesTelefono'];
            $fot='';
            $locid=$_REQUEST['cboLocalidad'];
            //var_dump($parametros);
            //si llega un nuevo archivo enviado lo copia al servidor
            if ($_FILES['filClientesFoto']['error']==0)
            {
                $ext = substr($_FILES['filClientesFoto']['name'], strrpos($_FILES['filClientesFoto']['name'],'.'));
                $nombre=microtime();
                copy($_FILES['filClientesFoto']['tmp_name'],'static\\imgs\\'.$nombre.$ext);
                $fot=$nombre.$ext;
                //echo "<img src=\"$fot\">";
            }
            else
                $fot=$_REQUEST['hidClientesFoto'];
            
            if ($id>0)
            {
                $parametros="'$dni','$fechanac','$fot',$id,$locid,'$nom','$tel'";
                $resultado=$miConexion->query("call modificar_cliente($parametros)");
            }
            else
            {
                $parametros="'$dni','$fechanac','$fot',$locid,'$nom','$tel'";
                $resultado=$miConexion->query("call insertar_cliente($parametros)");
            }

  }
  public function obtenerUno()
  {
    $miConexion=HelperDatos::obtenerConexion();
    $id=$_REQUEST['id'];
    $resultado=$miConexion->query("call obtener_cliente($id)");
    $registro= mysqli_fetch_array($resultado);
    return $registro;
  }
}