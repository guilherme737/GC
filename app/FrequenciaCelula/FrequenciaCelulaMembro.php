<?php

namespace SlimRest\FrequenciaCelula;

use Illuminate\Database\Eloquent\Model as Model;

class FrequenciaCelulaMembro extends Model {

    protected $table = 'frequenciacelulamembro';

    public function membros(){
        return $this->hasOne('\membro\Membro');
    }

}
