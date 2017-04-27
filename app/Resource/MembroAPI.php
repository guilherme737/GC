<?php

namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class MembroAPI extends Resource {

    public function routes() {

        $this->get('/membro', [$this, 'obterTodos']);

        $this->get("/membro/{id}", [$this, 'obterPorId']);

        $this->post("/membro", [$this, 'inserir']);

        $this->put("/membro/{id}", [$this, 'atualizar']);

        $this->delete("/membro/{id}", [$this, 'excluir']);
        
        $this->get('/funcoes', [$this, 'obterFuncoes']);
    }

    public function obterTodos($req, $res, $args) {

        //$membros = \Membro::find('all');

        /*
          $json = array_map(function($res){
          return $res->to_json();
          }, $membros);
         */

        return $this->respond($res, \Membro::collection_to_array());
    }

    public function obterPorId($req, $res, $args) {

        $membro = \Membro::find($args['id']);

        return $this->respond($res, $membro->attributes());
    }

    public function inserir($req, $res, $args) {

        $atributos = $req->getParsedBody();

        $membro = new \Membro();

        $membro->nome = $atributos['nome'];

        $membro->email = $atributos['email'];

        $membro->celular = $atributos['celular'];

        $membro->save();

        return $this->respond($res, ['membro' => $membro]);
    }

    public function atualizar($req, $res, $args) {

        $membro = \Membro::find($args['id']);

        $atributos = $req->getParsedBody();

        $membro->nome = $atributos['nome'];

        $membro->email = $atributos['email'];

        $membro->celular = $atributos['celular'];

        $membro->save();
    }

    public function excluir($req, $res, $args) {

        $membro = \Membro::find($args['id']);

        $membro->delete();
    }

    public function obterFuncoes($req, $res, $args) {

        $funcoes = array(
            array(
                "id" => 1,
                "descricao" => "Membro"
            ),
            array(
                "id" => 2,
                "descricao" => "Líder"
            ),            
            array(
                "id" => 3,
                "descricao" => "Discipulador"
            ),
            array(
                "id" => 4,
                "descricao" => "Pastor Rede"
            ),
            array(
                "id" => 5,
                "descricao" => "Frequentador Assíduo"
            ),
            
        );
        
        return $this->respond($res, $funcoes);
    }

}
