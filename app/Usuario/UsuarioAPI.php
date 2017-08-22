<?php

namespace SlimRest\Usuario;

use \SlimRest\Resource as Resource;
use SlimRest\Usuario\UsuarioRepository as UsuarioRepository;
use SlimRest\Usuario\Usuario as Usuario;
//require_once _APP . '/membro/membroRepository.php';

class UsuarioAPI extends Resource {

    public function routes() {

        $this->get('/usuario', [$this, 'obterTodos']);

        $this->get("/usuario/{id}", [$this, 'obterPorId']);

        $this->post("/usuario", [$this, 'inserir']);

        $this->put("/usuario/{id}", [$this, 'atualizar']);

        $this->delete("/usuario/{id}", [$this, 'excluir']);

        // $this->get('/funcoes', [$this, 'obterFuncoes']);

        // $this->get('/membro-pastores', [$this, 'obterPastores']);

        // $this->get('/membro-discipuladores-por-pastor/{id}', [$this, 'obterDiscipuladoresPorPastor']);

        // $this->get('/membro-lideres-por-discipulador/{id}', [$this, 'obterLideresPorDiscipulador']);
    }

    public function obterTodos($req, $res, $args) {

        $celulaRepository = new UsuarioRepository();

        $usuarios = $usuarioRepository->obterTodos();

//        return $res->getBody()->write(json_encode($membros));

        return $this->respond($res, $usuarios);
    }

    public function obterPorId($req, $res, $args) {

        $usuarioRepository = new UsuarioRepository();

        $usuario = $usuarioRepository->obterPorId($args['id']);

        return $this->respond($res, $usuario);
    }

    public function inserir($req, $res, $args) {

        $atributos = $req->getParsedBody();


        $usuario = new Usuario();

        $usuario->nome = $atributos['nome'];

        $usuario->email = $atributos['email'];

        $usuario->telefone = $atributos['telefone'];

        $usuario->funcao = $atributos['funcao'];

        $usuario->lider_id = $atributos['lider_id'];

//        $membro->save();

        $usuarioRepository = new UsuarioRepository();
        $usuarioRepository->inserir($usuario);

        return $this->respond($res, $usuario);
    }

    public function atualizar($req, $res, $args) {

        $usuarioRepository = new UsuarioRepository();

        $usuario = $usuarioRepository->obterPorId($args['id']);

        $atributos = $req->getParsedBody();

        $usuario->nome = $atributos['nome'];

        $usuario->email = $atributos['email'];

        $usuario->telefone = $atributos['telefone'];

        $usuario->funcao = $atributos['funcao'];

        $usuario->save();
    }

    public function excluir($req, $res, $args) {

        $usuarioRepository = new UsuarioRepository();

        $usuario = $usuarioRepository->obterPorId($args['id']);

        $usuario->delete();
    }

}
