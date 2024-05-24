<?php

namespace App\Models;

use CodeIgniter\Model;

class facturasModel extends Model
{
    // ...
    protected $table      = 'factura';
    protected $primaryKey = 'num_factura';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_cliente', 'fecha', 'estatus'];

    // public function validateEmail($email) { 
    //     return $this->where("correo =". $email)->find(); 
    //   }

    function guardarFactura($data){
        $clientes = $this->db->table($this->table)->insert($data);
        return $clientes;
    }

    function leyendoFactura(){
        $db = \Config\Database::connect();
            $builder = $db->table('factura');
            $builder->select("num_factura, cliente.id_cliente, nombre , fecha");
            $builder->where('factura.estatus', 1);
            $builder->join('cliente', 'factura.id_cliente = cliente.id_cliente');
            $query = $builder->get();
            $resultado = $query->getResult();
            return $resultado;
    }
//actualizando productos
    function updateData($data){
        $db = \Config\Database::connect();
        $builder = $db->table('factura');
        $builder->where('num_factura', $data["num_factura"]);
        $result = $builder->update($data);
        return $result ;
    }
    // //deletedata
    function deletedata($data){
        $db = \Config\Database::connect();
        $builder = $db->table('factura');
        $builder->where('num_factura', $data["num_factura"]);
        $result = $builder->update($data);
        return $result ;
    }

}