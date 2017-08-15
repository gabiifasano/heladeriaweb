<?php
require_once 'app/clientes/modelos/ModeloClientes.php';
require_once 'app/clientes/vistas/VistaClientes.php';

class ControladorClientes 
{
    //definimos las propiedades 
    private $modelo;
    private $vista;
    
    public function __construct() 
    {
         $this-> vista=new VistaClientes();
         $this->modelo=new ModeloClientes();
         
         if (isset($_REQUEST['accion']))
         {
            switch ($_REQUEST['accion'])
            {
                case 'listar':
                    $this->listar();
                    break;
                case 'eliminar':
                    $this->eliminar();
                    break;
                case 'nuevoCliente':
                    $this->nuevo();
                    break;
                case 'guardarEdicion':
                    $this->guardar();
                    break;
                case 'editar':
                    $this->editar();
                    break;
             
                default:
                    $this->listar();
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
    public function nuevo(){
        $this->vista->nuevo();
    }
    public function guardar(){
        $this->modelo->guardar();
        $registrosObtenidos=$this->modelo->obtenerTodos();
        $this->vista->listar($registrosObtenidos);
    }
    public function editar(){
        $registroObtenido=$this->modelo->obtenerUno();
        $this->vista->editar($registroObtenido);
    }
}

