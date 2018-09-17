<?php

use App\User;
use App\Videojuego;
use App\Videoconsola;
use App\Amistoso;
use App\Sala;
use App\Resultado;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_psp' =>$faker->numberBetween(100,500),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'status' => $status = $faker->randomElement([User::USUARIO_ACTIVO,User::USUARIO_INACTIVO]),
        'credito' =>$credito = $faker->numberBetween(10,500),
		'user_img_pr'=>$faker->randomElement(['user_df.png','user_w_df.png']),
        'verified'=>$verificado = $faker-> randomElement([User::USUARIO_VERIFICADO,User::USUARIO_NO_VERIFICADO]),
        'verification_token' => $verificado == User::USUARIO_VERIFICADO ? null : User::generarVerificationToken(),
        'admin'=>$faker->randomElement([User::USUARIO_ADMIN,User::USUARIO_REGULAR]),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Videojuego::class,function(Faker\Generator $faker){
    return[
        'nombre'=>$faker->word,
        'descripcion'=>$faker->word,
    ];
});

$factory->define(App\Videoconsola::class,function(Faker\Generator $faker){
    return[
        'nombre'=>$faker->word,
    ];
});
$factory->define(App\Sala::class,function(Faker\Generator $faker){
    return[
		'id_user_1'=>User::all()->random()->id,
		'id_user_2'=>User::all()->random()->id,
		'nombre'=>$faker->word,
		'modo_juego'=>$faker->randomElement([Sala::JUEGO_GRATIS,Sala::JUEGO_APUESTA]),
		'credito_apuesta'=>$faker->numberBetween(100,300),
		'fecha'=>$faker->date($format = 'Y-m-d', $max = 'now' ),
    ];
});
$factory->define(App\Amistoso::class,function(Faker\Generator $faker){
    return[
        'id_user1' =>User::all()->random()->id,
        'id_user2' =>User::all()->random()->id,
        'formatoJuego' =>$faker->randomElement([Amistoso::JUEGO_GRATIS,Amistoso::JUEGO_APUESTA]),
        'creditosApuesta'=>$faker->numberBetween(100,300),
        'jugadorGanador'=> $faker->numberBetween(0,2),
        'fechaPartido'=>$faker->date($format = 'Y-m-d', $max = 'now' ),
        'id_videojuego'=> Videojuego::all()->random()->id,
        'id_consola'=> Videoconsola::all()->random()->id,
    ];
});
