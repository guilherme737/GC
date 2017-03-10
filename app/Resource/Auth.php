<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class Auth extends Resource{

	public function routes(){
		$this->get('/login', [$this, 'doLogin']);
		$this->post('/login', [$this, 'postLogin']);
	}

	public function doLogin($req, $res, $args){

		return $this->respond($res, ['state' => true]);
	}

	public function postLogin($req, $res, $args){

		/*
		$params = $app->request()->getBody();
	    if ($params['email'] == "login" && $params['password'] == "password") {
	        $key = "example_key";
	        $token = array(
	            "id" => "1",
	            "exp" => time() + (60 * 60 * 24)
	        );
	        $jwt = JWT::encode($token, $key);
	        $app->response->headers->set('Content-Type', 'application/json');
	        echo json_encode(array("token" => $jwt));
	    }
	    */


		return $this->respond($res, ['state' => false]);
	}

}
