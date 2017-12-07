<?php

namespace SlimRest\FrequenciaCelula;

use \SlimRest\Resource as Resource;
use SlimRest\FrequenciaCelula\FrequenciaCelulaRepository as FrequenciaCelulaRepository;
use SlimRest\FrequenciaCelula\FrequenciaCelula as FrequenciaCelula;
//require_once _APP . '/membro/frequenciaCelulaRepository.php';

class FrequenciaCelulaAPI extends Resource {

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
        
        var_dump($req->getAttribute("jwt"));

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

        $frequencia->celula_id = $atributos['celula_id'];
        
        $frequencia->semana = $atributos['semana'];

        //TODO montar array objetos de membros (itens)
        // var_dump($atributos['membros']);

        $funcPreencherMembrosPresentes = function($value) {
            
            if ($value['presente'] && $value['presente'] == true) {
                
                return new FrequenciaCelulaMembro(array(
                    "membro_id" => $value["id"],
                    "presente" => $value["presente"]                            
                ));
            }

        };

        $membrosPresentes = array_map($funcPreencherMembrosPresentes, $atributos['membros']);

        $frequenciaCelulaRepository = new FrequenciaCelulaRepository();
        $frequenciaCelulaRepository->inserir($frequencia, $membrosPresentes);

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
