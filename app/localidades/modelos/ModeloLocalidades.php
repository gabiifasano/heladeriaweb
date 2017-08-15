<?php

require_once "app/core/HelperDatos.php";

class ModeloLocalidades
{
  public function obtenerTodos()
  {
    $miConexion=HelperDatos::obtenerConexion();
    $resultado=$miConexion->query("call obtener_localidades");
    return $resultado;
  }
  public function eliminar()
  {
      //compruebo si existe la variable
    if (isset ($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        $miConexion=HelperDatos::obtenerConexion();
        $resultado=$miConexion->query("call eliminar_localidad($id)");
    }
  }
  public function guardar(){
      
      $miConexion=HelperDatos::obtenerConexion();
      $id=$_REQUEST['txtLocalidadesId'];
      $nom=$_REQUEST['txtLocalidadesNombre'];
      //$dni=$_REQUEST['txtClientesDni'];
      //$fechanac=$_REQUEST['txtClientesFechaNacimiento'];
      //$tel=$_REQUEST['txtClientesTelefono'];
      //$locid=$_REQUEST['cboLocalidad'];
            //var_dump($parametros);
      //Si llega un nuevo archivo enviado lo copia al servidor
      /*if ($_FILES['filClientesFoto']['error']==0)
        {
            $ext = substr($_FILES['filClientesFoto']['name'], strrpos($_FILES['filClientesFoto']['name'],'.'));
            $nombre= microtime();
            copy($_FILES['filClientesFoto']['tmp_name'],'static\\imgs\\cliente'.$id.$ext);
            $fot='cliente'.$id.$ext;
            //echo "<img src=\"$fot\">";
        }
        else
            $fot=$_REQUEST['hidClientesFoto'];*/



   
       if ($id>0)
       {
            $parametros="$id,'$nom'";
            $resultado=$miConexion->query("call modificar_localidad($parametros)");
       }
       else
       {
             $parametros="$nom'";
             $resultado=$miConexion->query("call insertar_localidad($parametros)");
       }

  }
  public function obtenerUno()
  {
    $miConexion=HelperDatos::obtenerConexion();
    $id=$_REQUEST['id'];
    $resultado=$miConexion->query("call obtener_localidad($id)");
    $registro= mysqli_fetch_array($resultado);
    return $registro;
  }
}