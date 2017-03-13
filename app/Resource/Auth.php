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
	        $key = "1234";
	        $token = array(
	            "id" => "1",
	            "exp" => time() + (60 * 60 * 24)
	        );
	        $jwt = JWT::encode($token, $key);
	        //$res->headers->set('Content-Type', 'application/json');
	        //echo json_encode(array("token" => $jwt));
	    //}
	    


		return $this->respond($res, json_encode(array("token" => $jwt)));
	}

}
