<?php

namespace App\Controllers;

use App\Models\clientesModel;
use App\Models\facturasModel;


class Factura extends BaseApi
{
    protected $format = 'json';

    public function __construct()
    {
        parent::__construct();
        $this->clientesModel = new clientesModel();
        $this->facturaModel = new facturasModel();
    }
    public function index()
    {
        //return view('welcome_message');
        echo  view("facturas/facturasView");
    }
    public function cargandoClientes()
    {
        $clientes = $this->clientesModel->seleccionandoCliente();
        if (!empty($clientes)) {
            return $this->respuestaGenerica($clientes, "clientes leidos", 200);
        } else {
            return $this->respuestaGenerica(0, "error al almacenar Producto", 404);
        }
        ///var_dump($clientes)  ;
    }

    public function registro(){
        $datos['id_cliente'] = isset($_POST['clientes']) ? addslashes(trim($_POST['clientes'])) : "";
        $datos['fecha'] = isset($_POST['fecha']) ? addslashes(trim($_POST['fecha'])) : "";
        $datos['estatus'] = 1;

        
            $result = $this->facturaModel->insert($datos);
            if(!empty($result)){
                return $this->respuestaGenerica($result, "Factura almacenado", 200);
            }
            else{
                return $this->respuestaGenerica(0, "error al almacenar Factura", 404);
            }
        }

    // //actualizando datos
    public function actualizar(){
        $datos['num_factura'] = isset($_POST['id_factura']) ? addslashes(trim($_POST['id_factura'])) : "";
        $datos['id_cliente'] = isset($_POST['id_cliente']) ? addslashes(trim($_POST['id_cliente'])) : "";
        $datos['fecha'] = isset($_POST['fecha']) ? addslashes(trim($_POST['fecha'])) : "";

         $result = $this->facturaModel->updateData($datos);
        if(!empty($result)){
            return $this->respuestaGenerica($result, "producto Actualizado", 200);
        }
        else{
            return $this->respuestaGenerica(0, "error al almacenar producto", 404);
        }

       // var_dump($result);
    }

    public function eliminar(){
        $datos['num_factura'] = isset($_POST['id_factura']) ? addslashes(trim($_POST['id_factura'])) : "";
        $datos['estatus'] = 0;


         $result = $this->facturaModel->deletedata($datos);
        if(!empty($result)){
            return $this->respuestaGenerica($datos, "factura eliminada", 200);
        }
        else{
            return $this->respuestaGenerica(0, "error al elminar factura", 404);
        }

       // var_dump($result);
    }

    public function readFactura(){
        $result = $this->facturaModel->leyendoFactura();
        return  $this->respuestaGenerica($result, "Lectura ejecutada", 200);

    }
}
