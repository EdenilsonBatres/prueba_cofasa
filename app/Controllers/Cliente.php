<?php

namespace App\Controllers;
use App\Models\clientesModel;


class Cliente extends BaseApi
{
    protected $format = 'json';

    public function __construct()
	{
		//$this->UsuarioModel=new UsuariosModel(); modelos
        parent::__construct();
        $this->clienteModel = new clientesModel();
	}
    public function index()
    {
        //return view('welcome_message');
        echo  view("clientes/clientesForm");
    }

    public function registro(){
        $datos['nombre'] = isset($_POST['nombre']) ? addslashes(trim($_POST['nombre'])) : "";
        $datos['apellido'] = isset($_POST['apellido']) ? addslashes(trim($_POST['apellido'])) : "";
        $datos['direccion'] = isset($_POST['direccion']) ? addslashes(trim($_POST['direccion'])) : "";
        $datos['fecha_nacimiento'] = isset($_POST['fecha_nacimiento']) ? addslashes(trim($_POST['fecha_nacimiento'])) : "";
        $datos['telefono'] = isset($_POST['telefono']) ? addslashes(trim($_POST['telefono'])) : "";
        $datos['email'] = isset($_POST['email']) ? addslashes(trim($_POST['email'])) : "";
        $datos['id_categoria'] = isset($_POST['categoria']) ? addslashes(trim($_POST['categoria'])) : "";
        $datos['estatus'] = 1;

        $result = $this->clienteModel->insert($datos);
        if(!empty($result)){
            return $this->respuestaGenerica($datos, "cliente almacenado", 200);
        }
        else{
            return $this->respuestaGenerica(0, "error al almacenar cliente", 404);
        }

       // var_dump($datos);
    }
    //actualizando datos
    public function actualizar(){
        $datos['id_cliente'] = isset($_POST['id_cliente']) ? addslashes(trim($_POST['id_cliente'])) : "";
        $datos['nombre'] = isset($_POST['nombre']) ? addslashes(trim($_POST['nombre'])) : "";
        $datos['apellido'] = isset($_POST['apellido']) ? addslashes(trim($_POST['apellido'])) : "";
        $datos['direccion'] = isset($_POST['direccion']) ? addslashes(trim($_POST['direccion'])) : "";
        $datos['fecha_nacimiento'] = isset($_POST['fecha_nacimiento']) ? addslashes(trim($_POST['fecha_nacimiento'])) : "";
        $datos['telefono'] = isset($_POST['telefono']) ? addslashes(trim($_POST['telefono'])) : "";
        $datos['email'] = isset($_POST['email']) ? addslashes(trim($_POST['email'])) : "";
        $datos['id_categoria'] = isset($_POST['id_categoria']) ? addslashes(trim($_POST['id_categoria'])) : "";

         $result = $this->clienteModel->updateData($datos);
        if(!empty($result)){
            return $this->respuestaGenerica($datos, "cliente Actualizado", 200);
        }
        else{
            return $this->respuestaGenerica(0, "error al almacenar cliente", 404);
        }

       // var_dump($result);
    }
    public function eliminar(){
        $datos['id_cliente'] = isset($_POST['id_cliente']) ? addslashes(trim($_POST['id_cliente'])) : "";
        $datos['estatus'] = 0;


         $result = $this->clienteModel->deletedata($datos);
        if(!empty($result)){
            return $this->respuestaGenerica($datos, "cliente elminado", 200);
        }
        else{
            return $this->respuestaGenerica(0, "error al elminar cliente", 404);
        }

       // var_dump($result);
    }

    public function readClient(){
        $result = $this->clienteModel->leyendoCliente();
        return  $this->respuestaGenerica($result, "Lectura ejecutada", 200);

    }
}
