<?php

namespace SlimRest\Celula;

use \SlimRest\Resource as Resource;
use SlimRest\Celula\CelulaRepository as CelulaRepository;
use SlimRest\Celula\Celula as Celula;
//require_once _APP . '/membro/membroRepository.php';

class CelulaAPI extends Resource {

    public function routes() {

        $this->get('/celula', [$this, 'obterTodos']);

        $this->get("/celula/{id}", [$this, 'obterPorId']);

        $this->post("/celula", [$this, 'inserir']);

        $this->put("/celula/{id}", [$this, 'atualizar']);

        $this->delete("/celula/{id}", [$this, 'excluir']);

        // $this->get('/funcoes', [$this, 'obterFuncoes']);

        // $this->get('/membro-pastores', [$this, 'obterPastores']);

        // $this->get('/membro-discipuladores-por-pastor/{id}', [$this, 'obterDiscipuladoresPorPastor']);

        // $this->get('/membro-lideres-por-discipulador/{id}', [$this, 'obterLideresPorDiscipulador']);
    }

    public function obterTodos($req, $res, $args) {

        $celulaRepository = new CelulaRepository();

        $celulas = $celulaRepository->obterTodos();

//        return $res->getBody()->write(json_encode($membros));

        return $this->respond($res, $celulas);
    }

    public function obterPorId($req, $res, $args) {

        $celulaRepository = new CelulaRepository();

        $celula = $celulaRepository->obterPorId($args['id']);

        return $this->respond($res, $celula);
    }

    public function inserir($req, $res, $args) {

        $atributos = $req->getParsedBody();


        $celula = new Celula();

        $celula->nome = $atributos['nome'];

        $celula->email = $atributos['email'];

        $celula->telefone = $atributos['telefone'];

        $celula->funcao = $atributos['funcao'];

        $celula->lider_id = $atributos['lider_id'];

//        $membro->save();

        $celulaRepository = new CelulaRepository();
        $celulaRepository->inserir($celula);

        return $this->respond($res, $celula);
    }

    public function atualizar($req, $res, $args) {

        $celulaRepository = new CelulaRepository();

        $celula = $celulaRepository->obterPorId($args['id']);

        $atributos = $req->getParsedBody();

        $celula->nome = $atributos['nome'];

        $celula->email = $atributos['email'];

        $celula->telefone = $atributos['telefone'];

        $celula->funcao = $atributos['funcao'];

        $celula->save();
    }

    public function excluir($req, $res, $args) {

        $celulaRepository = new MembroRepository();

        $celula = $celulaRepository->obterPorId($args['id']);

        $celula->delete();
    }

    public function obterPastores($req, $res, $args) {

        $celulaRepository = new MembroRepository();

        $membros = $celulaRepository->obterPastores();

        return $this->respond($res, $membros);

    }

    public function obterDiscipuladoresPorPastor($req, $res, $args) {

        $celulaRepository = new MembroRepository();

        $membros = $celulaRepository->obterDiscipuladoresPorPastor($args['id']);

        return $this->respond($res, $membros);

    }

    public function obterLideresPorDiscipulador($req, $res, $args) {

        $membroRepository = new MembroRepository();

        $membros = $membroRepository->obterLideresPorDiscipulador($args['id']);

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
