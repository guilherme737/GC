<?php

namespace SlimRest\Usuario;

class UsuarioRepository {

    public function obterTodos() {

        return Usuario::all();
    }

    public function obterPorId($id) {
        return Usuario::find($id);
    }

    public function inserir($usuario) {

        $usuario->save();
    }

    public function alterar($usuario) {
        $usuario->save();
    }

    public function excluir($id) {
        $usuario = Usuario::find($id);
        $usuario->delete();
    }
    
    public function obterPorLoginESenha($login, $senha) {
        return Usuario::where([['login', '=', $login], ['senha', $senha]])->get();
    }

/*
    public function obterPastores() {
        return Membro::where('funcao', '=', 4)->get();
    }

    public function obterDiscipuladoresPorPastor($id) {
        return Membro::where([['funcao', '=', 3], ['lider_id', $id]])->get();
    }

    public function obterLideresPorDiscipulador($id) {
        return Membro::where([['funcao', '=', 2], ['lider_id', $id]])->get();
    }
*/


}
