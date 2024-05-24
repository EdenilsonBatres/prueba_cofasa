<?php

namespace App\Models;

use CodeIgniter\Model;

class productosModel extends Model
{
    // ...
    protected $table      = 'producto';
    protected $primaryKey = 'id_producto';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre', 'precio', 'stock', 'estatus'];

    // public function validateEmail($email) { 
    //     return $this->where("correo =". $email)->find(); 
    //   }

    function guardarProducto($data){
        $clientes = $this->db->table($this->table)->insert($data);
        return $clientes;
    }

    function leyendoProducto(){
        $db = \Config\Database::connect();
            $builder = $db->table('producto');
            $builder->select("*");
            $builder->where('estatus', 1);
            $query = $builder->get();
            $resultado = $query->getResult();
            return $resultado;
    }
//actualizando productos
    function updateData($data){
        $db = \Config\Database::connect();
        $builder = $db->table('producto');
        $builder->where('id_producto', $data["id_producto"]);
        $result = $builder->update($data);
        return $result ;
    }
    // //deletedata
    function deletedata($data){
        $db = \Config\Database::connect();
        $builder = $db->table('producto');
        $builder->where('id_producto', $data["id_producto"]);
        $result = $builder->update($data);
        return $result ;
    }

}