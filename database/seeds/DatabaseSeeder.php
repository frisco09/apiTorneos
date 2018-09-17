<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Amistoso;
use App\Videojuego;
use App\Videoconsola;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Amistoso::truncate();
        Videojuego::truncate();
        Videoconsola::truncate();

        $cantidadUsuarios = 200;
        $cantidadAmistosos = 100;
        $cantidadVideojuego = 5;
        $cantidadConsola = 3;

        factory(User::class, $cantidadUsuarios)->create();
        factory(Videojuego::class, $cantidadVideojuego)->create();
        factory(Videoconsola::class,$cantidadConsola)->create();
        factory(Amistoso::class,$cantidadAmistosos)->create();
    }
}
