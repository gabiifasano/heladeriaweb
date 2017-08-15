<?php
require_once 'app/core/HelperVistas.php';
class VistaProductos
{
  public function listar($productosObt)
  {
    echo "<table border='1' class='table table-bordered table-hover'>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Rubro</th>
            <th></th>
            <th></th>
        </tr>";
        while ($producto=mysqli_fetch_array($productosObt))
        {
          $id=$producto['productosid'];
          $descripcion=$producto['productosdescripcion'];
          $precio=$producto['productosprecio'];
          $enlaceEditar="index.php?seccion=productos&accion1=editar&id=$id";
          $enlaceEliminar="index.php?seccion=productos&accion=eliminar&id=$id";
          $onclick='return confirm("¿Seguro que desea eliminar al producto '.$descripcion.'?")';
          //$fechaNac=date_create($producto['productosfechanac']);
          //$fechaNacimiento=date_format($fechaNac,'d/m/Y');
            echo "<tr>
                 <td>$id</td>
                 <td>$descripcion</td>
                 <td>$precio</td>";
                 //echo "<td>$fechaNacimiento</td>";
                 //tambien se puede concatenar de manera directa el momento del array con el texto html
                 //en vez de colocarlo en una variable y luego imprimir la variable.
            echo "<td>".$producto['rubrosnombre']."</td>
                 <td><a href='$enlaceEditar'>Editar</a></td>
                <td><a href='$enlaceEliminar' onclick='$onclick'>Eliminar</a></td>
                </tr>";
        }
        echo "</table>";
  }
   public function nuevo(){
      //creamos una variable formulario 
       $formulario = file_get_contents('static/formularioproductos.html');
       $datosCliente=array('{productosid}'=>'',
                            '{productosdescripcion}'=>'',
                            '{productosprecio}'=>'',
                            '{productosfoto}'=>'silueta.jpg',
                            '{contenidoCboRubro}'=> HelperVistas::obtenerContenidoCboRubros(0));

    foreach ($datosCliente as $clave => $valor) {
      $formulario = str_replace($clave, $valor, $formulario);
    }
    //imprime la variable
    print $formulario;
  }
  public function editar($registroEditado){
      //creamos una variable formulario 
       $formulario = file_get_contents('static/formularioproductos.html');
       if($registroEditado['productofoto']=="")
           $foto="silueta.jpg";
       else
           $foto=$registroEditado['productofoto'];
       $datosProducto=array('{productosid}'=>$registroEditado['productosid'],
                            '{productosdescripcion}'=>$registroEditado['productosdescripcion'],
                            '{productosprecio}'=>$registroEditado['productosprecio'],
                            '{productosidrubro}'=>$registroEditado['productosidrubro'],
                            '{productosfoto}'=>$foto,
                            '{contenidoCboRubro}'=> HelperVistas::obtenerContenidoCboRubros($registroEditado['productosrubrosid']));

    foreach ($datosProducto as $clave => $valor) {
      $formulario = str_replace($clave, $valor, $formulario);
    }
    //imprime la variable
    print $formulario;
  }
}




































