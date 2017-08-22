<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;
use Firebase\JWT\JWT;

class Auth extends Resource{

	public function routes(){
		$this->get('/login', [$this, 'doLogin']);
		$this->post('/login', [$this, 'postLogin']);
	}

	public function doLogin($req, $res, $args){

		return $this->respond($res, ['state' => true]);
	}

	public function postLogin($req, $res, $args){


		$params = $req->getBody();
	    //if ($params['email'] == "login" && $params['password'] == "password") {

			//TODO verificar se as credenciais são validas na tabela, retornar os dados para montar o token

	        $key = "1234";
	        $token = array(
	            "id" => "1",
							"user" => "Guilherme",
							"pswd" => "123456",
							"funcao" => "2"
	            "exp" => time() + (60 * 60 * 24)
	        );
	        $jwt = JWT::encode($token, $key);
	        //$res->headers->set('Content-Type', 'application/json');
	        //echo json_encode(array("token" => $jwt));
	    //}


		//TODO talvez retornar Nome e função do usuario logado para mostrar no sistema

		return $this->respond($res, array("success" => true,"token" => $jwt, "user" => "Ricceli Alencar", "funcao" => 2));
	}

}
