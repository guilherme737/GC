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
    
    public function alterar() {
        
    }
    
    public function excluir() {
        
    }
    
}
