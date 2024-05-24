<?php 

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

// require_once APPPATH . '/libraries/jwt/autoload.php';
// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;

class BaseApi extends ResourceController {

    // protected $format    = 'json';
	// public $key="M0n!t0r3o";

	public function __construct()
	{
		
	}
	

    public function respuestaGenerica($data, $msj = "", $code)
    {
        switch ($code) {
            case 200: //OK:solicitud aceptada
                return $this->respond(array(
                    "data" => $data,
                    "msj" => $msj,
                    "code" => $code
                ));
                break;
            case 201: //CREATED
                return $this->respond(array(
                    "data" => $data,
                    "msj" => $msj,
                    "code" => $code
                ));
                break;
            case 204: //NO CONTENT: solicitud procesada con exito pero no tenia datos que devolver
                return $this->respond(array(
                    "data" => "NO CONTENT",
                    "msj" => $msj,
                    "code" => $code
                ));
                break;
            case 400: //BAD REQUESR
                return $this->respond(array(
                    "data" => "BAD REQUEST",
                    "msj" => $msj,
                    "code" => $code
                ));
            case 401: //UNAUTHORIZED: solicitud no autorizada
                return $this->respond(array(
                    "data" => "UNAUTHORIZED",
                    "msj" => $msj,
                    "code" => $code
                ));
            case 403: //FORBIDDEN: el cliente no tiene acceso
                return $this->respond(array(
                    "data" => "FORBIDDEN",
                    "msj" => $msj,
                    "code" => $code
                ));
            case 404: //NOT FOUND: no encontrado
                return $this->respond(array(
                    "data" => "NOT FOUND",
                    "msj" => $msj,
                    "code" => $code
                ));
            case 500: //INTERNAL SERVER ERROR: error interno del servidor
                return $this->respond(array(
                    "data" => "INTERNAL SERVER ERROR",
                    "msj" => $msj,
                    "code" => $code
                ));

            default:
                return $this->respond(array(
                    "data" => "FATAL",
                    "msj" => "error al recivir los datos",
                    "code" => -1
                ));
        }
    }

	// function build_token($data="")
    // {
    //     $time = time();


    //     $token = array(
    //         'iat' => $time, // Tiempo que inició el token
    //         'exp' => $time + (60*60*30), // Tiempo que expirará el token (+1 hora)
    //         'data' => $data
    //     );

    //     $jwt = JWT::encode($token, $this->key,"HS256");
    //     return $jwt;
       
    // }
    // function autorization(){
    //     $auth=$this->request->getHeader("Authorization")->getValue();
    //     $jwt =  str_replace("Bearer ","",$auth);
      
    //     try{
    //         $data = JWT::decode($jwt, new Key($this->key, 'HS256'));  
    //        return $data;
    //     }catch (\Exception $e){
    //         $data =null;
    //     }
        
    //     $json["error"]=1;
    //     $json["message"] = "No autorizado";
    //     print_r(json_encode($json));
    //     die();
    
    // }

}

?>