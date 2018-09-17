<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Videjuego;
use App\Videoconsola;
use App\Amistoso;

class CreateAmistososTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amistosos', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('id_user1')->unsigned();
            $table->integer('id_user2')->unsigned();
            $table->string('formatoJuego');
            $table->integer('creditosApuesta');
            $table->integer('jugadorGanador');
            $table->string('fechaPartido');
            $table->integer('id_videojuego')->unsigned();
            $table->integer('id_consola')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('amistosos', function($table) {
            $table->foreign('id_user1')->references('id')->on('users');
            $table->foreign('id_user2')->references('id')->on('users');
            $table->foreign('id_videojuego')->references('id')->on('videojuegos');
            $table->foreign('id_consola')->references('id')->on('videoconsolas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amistosos');
    }
}
