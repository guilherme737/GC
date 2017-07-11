<?php

namespace SlimRest\frequencia-celula;

use \SlimRest\Resource as Resource;
use SlimRest\frequencia-celula\frequenciaCelulaRepository as FrequenciaCelulaRepository;
use SlimRest\frequencia-celula\FrequenciaCelula as FrequenciaCelula;
//require_once _APP . '/membro/frequenciaCelulaRepository.php';

class MembroAPI extends Resource {

    public function routes() {

        $this->get('/frequencia-celula', [$this, 'obterTodos']);

        $this->get("/frequencia-celula/{id}", [$this, 'obterPorId']);

        $this->post("/frequencia-celula", [$this, 'inserir']);

        $this->put("/frequencia-celula/{id}", [$this, 'atualizar']);

        $this->delete("/frequencia-celula/{id}", [$this, 'excluir']);
        
        $this->get('/frequencia-membros-por-lider/{id}', [$this, 'obterMembrosPorLider']);
    }

    public function obterTodos($req, $res, $args) {

        $frequenciaCelulaRepository = new FrequenciaCelulaRepository();

        $frequencias = $frequenciaCelulaRepository->obterTodos();

//        return $res->getBody()->write(json_encode($frequencias));

        return $this->respond($res, $frequencias);
    }

    public function obterPorId($req, $res, $args) {
        
        $frequenciaCelulaRepository = new FrequenciaCelulaRepository();

        $frequencia = $frequenciaCelulaRepository->obterPorId($args['id']);

        return $this->respond($res, $frequencia);
    }

    public function inserir($req, $res, $args) {

        $atributos = $req->getParsedBody();
        

        $frequencia = new FrequenciaCelula();

        $frequencia->nome = $atributos['nome'];

        $frequencia->email = $atributos['email'];

        $frequencia->telefone = $atributos['telefone'];
        
        $frequencia->funcao = $atributos['funcao'];

        $frequencia->lider_id = $atributos['lider_id'];

//        $membro->save();
        
        $frequenciaCelulaRepository = new FrequenciaCelulaRepository();
        $frequenciaCelulaRepository->inserir($frequencia);

        return $this->respond($res, $frequencia);
    }

    public function atualizar($req, $res, $args) {
        
        $frequenciaCelulaRepository = new FrequenciaCelulaRepository();

        $frequencia = $frequenciaCelulaRepository->obterPorId($args['id']);

        $atributos = $req->getParsedBody();

        $frequencia->nome = $atributos['nome'];

        $frequencia->email = $atributos['email'];

        $frequencia->telefone = $atributos['telefone'];

        $frequencia->funcao = $atributos['funcao'];

        $frequencia->save();
    }

    public function excluir($req, $res, $args) {

        $frequenciaCelulaRepository = new FrequenciaCelulaRepository();

        $frequencia = $frequenciaCelulaRepository->obterPorId($args['id']);

        $frequencia->delete();
    }

    public function obterMembrosPorLider($req, $res, $args) {

        $frequenciaCelulaRepository = new FrequenciaCelulaRepository();

        $frequencias = $frequenciaCelulaRepository->obterMembrosPorLider($args['id']);

        return $this->respond($res, $frequencias);

    }


}
