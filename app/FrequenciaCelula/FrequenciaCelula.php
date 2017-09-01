<?php

namespace SlimRest\FrequenciaCelula;

use Illuminate\Database\Eloquent\Model as Model;
use \FrequenciaCelulaMembro as FrequenciaCelulaMembro;

class FrequenciaCelula extends Model {

    protected $table = 'frequenciacelula';

    public function frequenciasMembros(){
        return $this->hasMany('SlimRest\FrequenciaCelula\FrequenciaCelulaMembro', "frequenciacelula_id");
    }

}
