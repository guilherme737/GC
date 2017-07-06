<?php

namespace SlimRest\membro;

class MembroRepository {
    
    public function obterTodos() {
        
        return Membro::all();
    }
    
    public function obterPorId($id) {
        return Membro::find($id);
    }
    
    public function inserir($membro) {
        
        $membro->save();
    }
    
    public function alterar($membro) {
        $membro->save();
    }
    
    public function excluir($id) {
        $membro = Membro::find($id);
        $membro->delete();
    }

    public function obterPastores() {
        return Membro::where('funcao', '=', 4)->get();
    }
    
}
