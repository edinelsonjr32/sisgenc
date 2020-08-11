<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUsuario extends Model
{
    protected $table = 'tipo_usuario';
    protected $fillables = [
        'nome',
        'status'
    ];
    use SoftDeletes;
}
