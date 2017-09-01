<?php

namespace SlimRest\FrequenciaCelula;

class FrequenciaCelulaRepository {

    public function obterTodos() {

        return FrequenciaCelula::all();
    }

    public function obterPorId($id) {
        return FrequenciaCelula::find($id);
    }

    public function inserir($frequenciaCelula, $arrMembros) {
        //FrequenciaCelula::save($frequenciaCelula)->frequenciasMembros()->saveMany($array_de_membros_presentes);
        $frequenciaCelula->save();
        $frequenciaCelula->frequenciasMembros()->createMany($arrMembros);
        //$frequenciaCelula->save();
    }

    public function alterar($frequenciaCelula) {
        $frequenciaCelula->save();
    }

    public function excluir($id) {
        $frequenciaCelula = FrequenciaCelula::find($id);
        $frequenciaCelula->delete();
    }

    public function obterMembrosPorLider($id) {
        return FrequenciaCelula::where([['lider_id', $id]])->get();
    }



}
