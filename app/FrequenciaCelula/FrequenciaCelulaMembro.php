<?php

namespace SlimRest\FrequenciaCelula;

use Illuminate\Database\Eloquent\Model as Model;

class FrequenciaCelulaMembro extends Model {

    protected $table = 'frequenciacelulamembro';
    
    protected $fillable = ['membro_id', 'presente'];

    public function membro(){
        return $this->hasOne('\membro\Membro', "membro_id");
    }

    public function frequenciaCelula() {
        return $this->belongsTo('\FrequenciaCelula');
    }

}
