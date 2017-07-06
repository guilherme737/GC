<?php

namespace SlimRest\membro;

use \SlimRest\Resource as Resource;
use SlimRest\membro\MembroRepository as MembroRepository;
use SlimRest\membro\Membro as Membro;
//require_once _APP . '/membro/membroRepository.php';

class MembroAPI extends Resource {

    public function routes() {

        $this->get('/membro', [$this, 'obterTodos']);

        $this->get("/membro/{id}", [$this, 'obterPorId']);

        $this->post("/membro", [$this, 'inserir']);

        $this->put("/membro/{id}", [$this, 'atualizar']);

        $this->delete("/membro/{id}", [$this, 'excluir']);
        
        $this->get('/funcoes', [$this, 'obterFuncoes']);

        $this->get('/membro-pastores', [$this, 'obterPastores']);
    }

    public function obterTodos($req, $res, $args) {

        $membroRepository = new MembroRepository();

        $membros = $membroRepository->obterTodos();

//        return $res->getBody()->write(json_encode($membros));

        return $this->respond($res, $membros);
    }

    public function obterPorId($req, $res, $args) {
        
        $membroRepository = new MembroRepository();

        $membro = $membroRepository->obterPorId($args['id']);

        return $this->respond($res, $membro);
    }

    public function inserir($req, $res, $args) {

        $atributos = $req->getParsedBody();
        

        $membro = new Membro();

        $membro->nome = $atributos['nome'];

        $membro->email = $atributos['email'];

        $membro->telefone = $atributos['telefone'];
        
        $membro->funcao = $atributos['funcao'];

        $membro->lider_id = $atributos['lider_id'];

//        $membro->save();
        
        $membroRepository = new MembroRepository();
        $membroRepository->inserir($membro);

        return $this->respond($res, $membro);
    }

    public function atualizar($req, $res, $args) {
        
        $membroRepository = new MembroRepository();

        $membro = $membroRepository->obterPorId($args['id']);

        $atributos = $req->getParsedBody();

        $membro->nome = $atributos['nome'];

        $membro->email = $atributos['email'];

        $membro->telefone = $atributos['telefone'];

        $membro->funcao = $atributos['funcao'];

        $membro->save();
    }

    public function excluir($req, $res, $args) {

        $membroRepository = new MembroRepository();

        $membro = $membroRepository->obterPorId($args['id']);

        $membro->delete();
    }

    public function obterPastores($req, $res, $args) {

        $membroRepository = new MembroRepository();

        $membros = $membroRepository->obterPastores();

        return $this->respond($res, $membros);

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
