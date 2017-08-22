<?php

namespace SlimRest\Usuario;

use Illuminate\Database\Eloquent\Model as Model;

class Usuario extends Model {

    protected $table = 'usuario';

    public function membro(){
        return $this->hasOne('\membro\Membro');
    }

}
