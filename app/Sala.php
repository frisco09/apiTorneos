<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Amistoso;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
    use SoftDeletes;

    protected $dates =['delete_at'];
    const JUEGO_GRATIS = "gratis";
    const JUEGO_APUESTA = "apuesta";
	
    protected $fillable = [
        'id',
        'id_user_1',
		'id_user_2',
		'nombre',
		'modo_juego',
		'credito_apuesta',
		'fecha',	
    ];
	//gratis
    public function amistoso_gratis()
    {
        return $this->modo_juego == Amistoso::JUEGO_GRATIS;
    }
    //apuesta
    public function amistoso_apuesta()
    {
        return $this ->modo_juego == Amistoso::JUEGO_APUESTA;
    }
    //una consola tiene muchos amistosos
    public function consolaAmistoso(){
        return $this->hasOne(Amistoso::class);
    }
}
