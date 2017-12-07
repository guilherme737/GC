<?php

namespace SlimRest\Auth;

use \SlimRest\Resource as Resource;
use Firebase\JWT\JWT;
use SlimRest\Usuario\Usuario as Usuario;
use SlimRest\Usuario\UsuarioRepository as UsuarioRepository;

class AuthAPI extends Resource {

    public function routes() {
        $this->get('/login', [$this, 'doLogin']);
        $this->post('/login', [$this, 'postLogin']);
    }

    public function doLogin($req, $res, $args) {

        return $this->respond($res, ['state' => true]);
    }

    public function postLogin($req, $res, $args) {


//        $params = $req->getBody();
        $atributos = $req->getParsedBody();
        
        $usuarioRepository = new UsuarioRepository();
        
        $usuarioRepository->obterPorLoginESenha($atributos['usuario'], $atributos['senha']);
        
        //TODO verificar se as credenciais são validas na tabela, retornar os dados para montar o token
        if ($atributos['usuario'] == "teste" && $atributos['senha'] == "teste") {
            
            $key = "1234";
            $token = array(
                "id" => "1",
                "user" => "Guilherme",
                "pswd" => "123456",
                "funcao" => "2",
                "exp" => time() + (60 * 60 * 24)
            );
            $jwt = JWT::encode($token, $key);
            //$res->headers->set('Content-Type', 'application/json');
            //echo json_encode(array("token" => $jwt));
            //}
            //TODO talvez retornar Nome e função do usuario logado para mostrar no sistema

            return $this->respond($res, 
                    array("success" => true, 
                        "token" => $jwt, 
                        "id" => 1, 
                        "user" => "Ricceli Alencar", 
                        "funcao" => 2
                    )
                );
            
        } else {
            return $this->respond($res, array("success" => false, "erro" => 403, "mensagem" => "Credenciais Incorretas"));
        }
    }

}
