<?php
require_once 'app/rubros/modelos/ModeloRubros.php';
require_once 'app/rubros/vistas/VistaRubros.php';

class ControladorRubros 
{
    //definimos las propiedades 
    private $modelo;
    private $vista;
    
    public function __construct() 
    {
         $this-> vista=new VistaRubros();
         $this->modelo=new ModeloRubros();
         
         if (isset($_REQUEST['accion']))
         {
            switch ($_REQUEST['accion'])
            {
                case 'listar':
                    $this-> listar();
                    break;
                case 'eliminar':
                    $this-> eliminar();
                    break;
             
                default:
                    $this-> listar();
                    break;
            }
         }
         else 
             $this->listar();
    }
    public function listar()
    {
        $registrosObtenidos=$this->modelo->obtenerTodos();
        $this->vista->listar($registrosObtenidos);
    }
    public function eliminar() {
        $this->modelo->eliminar();
        $this->listar();
    }
}



