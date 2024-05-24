<?php

namespace App\Controllers;
use App\Models\productosModel;

class Producto extends BaseApi
{
    protected $format = 'json';

    public function __construct()
	{
        parent::__construct();
        $this->productoModel = new productosModel();
	}
    public function index()
    {
        //return view('welcome_message');
        echo  view("productos/productosView");
    }

    public function registro(){
        $datos['nombre'] = isset($_POST['nombre']) ? addslashes(trim($_POST['nombre'])) : "";
        $datos['precio'] = isset($_POST['precio']) ? addslashes(trim($_POST['precio'])) : "";
        $datos['stock'] = isset($_POST['stock']) ? addslashes(trim($_POST['stock'])) : "";
        $datos['estatus'] = 1;
        //validaciones 
        if($datos['precio'] < 600){
            return $this->respuestaGenerica(0, "error al almacenar Producto, exede requerimiento de precio", 404);
        }elseif($datos['stock'] < 1000 || $datos['stock'] > 100000 ){
            return $this->respuestaGenerica(0, "error al almacenar Producto,exede requerimiento de costo ", 404);
        }else{
            $result = $this->productoModel->insert($datos);
            if(!empty($result)){
                return $this->respuestaGenerica($datos, "Producto almacenado", 200);
            }
            else{
                return $this->respuestaGenerica(0, "error al almacenar Producto", 404);
            }
        }

      

       // var_dump($datos);
    }
    // //actualizando datos
    public function actualizar(){
        $datos['id_producto'] = isset($_POST['id_producto']) ? addslashes(trim($_POST['id_producto'])) : "";
        $datos['nombre'] = isset($_POST['nombre']) ? addslashes(trim($_POST['nombre'])) : "";
        $datos['precio'] = isset($_POST['precio']) ? addslashes(trim($_POST['precio'])) : "";
        $datos['stock'] = isset($_POST['stock']) ? addslashes(trim($_POST['stock'])) : "";

         $result = $this->productoModel->updateData($datos);
        if(!empty($result)){
            return $this->respuestaGenerica($result, "producto Actualizado", 200);
        }
        else{
            return $this->respuestaGenerica(0, "error al almacenar producto", 404);
        }

       // var_dump($result);
    }
    public function eliminar(){
        $datos['id_producto'] = isset($_POST['id_producto']) ? addslashes(trim($_POST['id_producto'])) : "";
        $datos['estatus'] = 0;


         $result = $this->productoModel->deletedata($datos);
        if(!empty($result)){
            return $this->respuestaGenerica($datos, "producto elminado", 200);
        }
        else{
            return $this->respuestaGenerica(0, "error al elminar producto", 404);
        }

       // var_dump($result);
    }

    public function readProducto(){
        $result = $this->productoModel->leyendoProducto();
        return  $this->respuestaGenerica($result, "Lectura ejecutada", 200);

    }
}
