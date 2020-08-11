<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;
    protected $table = 'estado';
    protected $fillable = [
        'nome',
        'status'
    ];

    public function cidade(){
        return $this->hasMany('App\Admin\Cidade');
    }

}
