<?php

namespace SlimRest\FrequenciaCelula;

use Illuminate\Database\Eloquent\Model as Model;

class FrequenciaCelula extends Model {

    protected $table = 'frequenciacelula';

    public function membros(){
        return $this->hasMany('\membro\Membro');
    }

}
