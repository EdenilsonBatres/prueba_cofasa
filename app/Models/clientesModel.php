<?php

namespace App\Models;

use CodeIgniter\Model;

class clientesModel extends Model
{
    // ...
    protected $table      = 'cliente';
    protected $primaryKey = 'id_cliente';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre', 'apellido', 'direccion', 'fecha_nacimiento', 'telefono', 'email', 'id_categoria','estatus'];

    // public function validateEmail($email) { 
    //     return $this->where("correo =". $email)->find(); 
    //   }

    function guardarCliente($data){
        $clientes = $this->db->table($this->table)->insert($data);
        return $clientes;
    }

    function leyendoCliente(){
        $db = \Config\Database::connect();
            $builder = $db->table('cliente');
            $builder->select("*");
            $builder->where('estatus', 1);
            $query = $builder->get();
            $resultado = $query->getResult();
            return $resultado;
    }

    function updateData($data){
        $db = \Config\Database::connect();
        $builder = $db->table('cliente');
        $builder->where('id_cliente', $data["id_cliente"]);
        $result = $builder->update($data);
        return $result ;
    }
    //deletedata
    function deletedata($data){
        $db = \Config\Database::connect();
        $builder = $db->table('cliente');
        $builder->where('id_cliente', $data["id_cliente"]);
        $result = $builder->update($data);
        return $result ;
    }
    //
    function seleccionandoCliente(){
        $db = \Config\Database::connect();
            $builder = $db->table('cliente');
            $builder->select("id_cliente, nombre");
            $builder->where('estatus', 1);
            $query = $builder->get();
            $resultado = $query->getResult();
            return $resultado;
    }

}