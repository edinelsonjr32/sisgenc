<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use SoftDeletes;

    protected $table = 'cidade';

    protected $fillable = [
        'nome',
        'status',
        'estadoId'
    ];

    public function estado(){
        return $this->belongsTo('App\Admin\Estado');
    }

    public function unidades()
    {
        return $this->hasMany('App\Admin\Unidade');
    }
}
