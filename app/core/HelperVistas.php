<?php

class HelperVistas
{
        //arma el contenido del combo localidades recibiendo como parametro el id de la localidad que 
        //debe quedar seleccionada (si estamos editando un cliente)
	public static function obtenerContenidoCboLocalidades($idLoc)
	{
            //obtengo todas las localidades
            $miConexion=HelperDatos::obtenerConexion();
            $tablaLocalidades=$miConexion->query("call obtener_localidades");
            $contenidoCboLocalidad="";
            //recorro uno a uno los registros obtenidos armando cada valor del combo y además evaluo
            //si el ID de la localidad es igual al parametro recibido para definir que quede seleccionado
            while ($localidad=mysqli_fetch_array($tablaLocalidades))
            {
              $id=$localidad['localidadesid'];
              $nombre=$localidad['localidadesnombre'];
              if ($id==$idLoc)
                $contenidoCboLocalidad.="<option value='$id' selected>$nombre</option>";
              else
                $contenidoCboLocalidad.="<option value='$id'>$nombre</option>";
            }
            //devuelvo todos los <option value> creados en el while
            return $contenidoCboLocalidad;

	}
        public static function obtenerContenidoCboRubros($idRub)
	{
            //obtengo todas las localidades
            $miConexion=HelperDatos::obtenerConexion();
            $tablaRubros=$miConexion->query("call obtener_rubros");
            $contenidoCboRubro="";
            //recorro uno a uno los registros obtenidos armando cada valor del combo y además evaluo
            //si el ID de la localidad es igual al parametro recibido para definir que quede seleccionado
            while ($rubro=mysqli_fetch_array($tablaRubros))
            {
              $id=$rubro['rubrosid'];
              $nombre=$rubro['rubrosnombre'];
              if ($id==$idRub)
                $contenidoCboRubro.="<option value='$id' selected>$nombre</option>";
              else
                $contenidoCboRubro.="<option value='$id'>$nombre</option>";
            }
            //devuelvo todos los <option value> creados en el while
            return $contenidoCboRubro;

	}
}