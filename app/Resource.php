<?php
namespace SlimRest;

use Firebase\JWT\JWT;

abstract class Resource {
	// for generating JWT auth token
	// TODO store this in environment variable
	//private $secret_jwt = "1234";

	public $app;

  public $container;

	public function __construct($app){

		$this->app = $app;

		$this->routes();

    $this->addFiltro();

	}

	abstract function routes();

  public function respond($response, $reply, $http_status=200){
    return $this->app->response($response, json_encode($reply), $http_status);
  }

	public function get($route, $callback){
		return $this->app->route('get', $route, $callback);
	}
	public function post($route, $callback){
		return $this->app->route('post', $route, $callback);
	}
	public function put($route, $callback){
		return $this->app->route('put', $route, $callback);
	}
	public function delete($route, $callback){
		return $this->app->route('delete', $route, $callback);
	}


  public function addFiltro() {

    $appInstance = $this->app->app;
    
    $appInstance->add(new \Slim\Middleware\JwtAuthentication([
        
        "secret" => "1234",
        "rules" => [
            new \Slim\Middleware\JwtAuthentication\RequestPathRule([
                "path" => "/",
                "passthrough" => ["/login"]
            ]),
            new \Slim\Middleware\JwtAuthentication\RequestMethodRule([
                "passthrough" => ["OPTIONS"]
            ])
        ],
        "callback" => function ($request, $response, $arguments) use ($appInstance) {
            $appInstance->jwt = $arguments["decoded"];
            //print_r($appInstance->jwt);
        }        

    ]));
    
  }

  /*
    // this method validates jwt token passed in Authorization header and retrive back the token information
  public function authorize($request){

    $message = "Using token from request header";

    $header = $request->getHeader("Authorization");

    $header = isset($header[0]) ? $header[0] : "";

    $token = "";
    
    if (preg_match("/Bearer\s+(.*)$/i", $header, $matches)) {
      // decode the token
      $token = $matches[1];
    }

    // Bearer not found, try a cookie. 
    $cookie_params = $request->getCookieParams();

    if (isset($cookie_params["token"])) {
        $token = $cookie_params["token"];
    };

    if($token != ""){

      return $this->decodeToken($token);
    }

    return false;
    
  }

  public function decodeToken($token){

    try {

        return JWT::decode(
            $token,
            $this->secret_jwt,
            ["HS256", "HS512", "HS384", "RS256"]
        );

    } catch (\Exception $exception) {
        return false;
    }
  }

  public function encodeToken($data){

    return JWT::encode($data, $this->secret_jwt);

  }
  */

}
