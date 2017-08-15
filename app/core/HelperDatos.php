<?php

class HelperDatos
{
  public static function obtenerConexion()
  {
    require_once "app/core/parametros.php";
    $miConexion= new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if ($miConexion->connect_errno)
        {
            echo 'error en la conexión a la base de datos';
        }
        else
        {
          $acentos = $miConexion->query("SET NAMES 'utf8'");
        }
        return $miConexion;
  }
}