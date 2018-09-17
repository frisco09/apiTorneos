<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use App\Amistoso;
use App\Sala;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */	
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_psp');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->default(User::USUARIO_INACTIVO);
            $table->string('credito')->nullable();
            $table->string('verified')->dafault(User::USUARIO_NO_VERIFICADO);
            $table->string('verification_token')->nullable();
            $table->string('admin')->default('user_df.png');
			$table->string('user_img_pr')->default(User::USUARIO_INACTIVO);;
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		//Schema::drop('salas');
        Schema::dropIfExists('users');
    }
}
