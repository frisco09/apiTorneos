<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Amistoso;
use Illuminate\Database\Eloquent\SoftDeletes;

class Videoconsola extends Model
{
    use SoftDeletes;

    protected $dates =['delete_at'];
    protected $fillable = [
        'id',
        'nombre',
    ];

    //una consola tiene muchos amistosos
    public function consolaAmistoso(){
        return $this->hasMany(Amistoso::class);
    }
}