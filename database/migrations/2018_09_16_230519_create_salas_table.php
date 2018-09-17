<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;
use App\Videjuego;
use App\Videoconsola;
use App\Amistoso;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('id_user1')->unsigned();
            $table->integer('id_user2')->unsigned();
			$table->string('nombre')->nullable();
            $table->string('modo_juego');
            $table->integer('credito_apuesta');
            $table->string('fechaPartido');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('salas', function($table) {
            $table->foreign('id_user1')->references('id')->on('users');
            $table->foreign('id_user2')->references('id')->on('users');

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
