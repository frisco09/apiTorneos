<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use app\Amistoso;

class Videojuego extends Model
{
    use SoftDeletes;

    protected $dates =['delete_at'];
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
    ];

    //un videojuego tiene muchos amistosos
    public function juegoAmistoso(){
        return $this->hasMany(Amistoso::class);
    }
}
