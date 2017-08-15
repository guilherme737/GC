<?php

namespace SlimRest\Celula;

class CelulaRepository {

    public function obterTodos() {

        return Celula::all();
    }

    public function obterPorId($id) {
        return Celula::find($id);
    }

    public function inserir($celula) {

        $membro->save();
    }

    public function alterar($celula) {
        $celula->save();
    }

    public function excluir($id) {
        $celula = Celula::find($id);
        $celula->delete();
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
