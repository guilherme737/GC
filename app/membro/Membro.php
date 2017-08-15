<?php

namespace SlimRest\membro;

use Illuminate\Database\Eloquent\Model as Model;

class Membro extends Model {

    protected $table = 'membro';

    public function lideres() {
        return $this->hasMany(Membro::class, 'lider_id', 'id');
    }

}
