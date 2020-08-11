<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model
{
    use SoftDeletes;
    protected $table = 'unidade';

    protected $fillable = [
        'nome',
        'cidadeId',
        'rua',
        'numero',
        'bairro',
        'cep',
        'status'
    ];

    public function cidade(){
        $this->belongsTo('App\Admin\Cidade');
    }
}
