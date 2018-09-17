<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Videojuego;
use App\Videoconsola;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amistoso extends Model
{
    use SoftDeletes;

    protected $dates =['delete_at'];
    const JUEGO_GRATIS = "gratis";
    const JUEGO_APUESTA = "apuesta";
    
    protected $fillable = [
        'id',
        'id_user1',
        'id_user2',
        'formatoJuego',
        'creditosApuesta',
        'jugadorGanador',
        'fechaPartido',
        'id_videojuego',
        'id_videoconsola',
    ];
	//gratis
    public function amistoso_gratis()
    {
        return $this->formatoJuego == Amistoso::JUEGO_GRATIS;
    }
    //apuesta
    public function amistoso_apuesta()
    {
        return $this ->formatoJuego == Amistoso::JUEGO_APUESTA;
    }

    //un amistoso pertenece a un videojuego
    public function juego(){
        return $this->belongsTo (Videojuego::class);
    }
    //un amistoso pertenece a una consola
    public function consola(){
        return $this->belongsTo(Videoconsola::class);
    }
    //un amistoso tiene muchos(2) usuarios
    public function participantes()
    {
        return $this-> hasMany(User::class);
    }
	//un amistoso pertenece a una sala
	    public function sala(){
			return $this->belongsTo (Sala::class);
    }
}