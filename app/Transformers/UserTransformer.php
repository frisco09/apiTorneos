<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identificador'=>(int)$user->id,
			'nombre'=>(string)$user->name,
			'usuario_psp'=>(string)$user->user_psp,
			'correo'=>(string)$user->email,
			'estado'=>(string)$user->status,
			'cantidad'=>(string)$user->credito,
			'esVerificado'=>(int)$user->verified,
			'esAdministrador'=>($user->admin===true),
			'fechaCreacion'=>(string)$user->created_at,
			'fechaActulizacion'=>(string)$user->updated_at,
			'fechaEliminacion'=>isset($user->deleted_at) ? (string) $user->deleted_at : null,
			'fotoPerfil'=>(string)$user->user_img_pr,
			'claveAcceso'=>(string)$user->password,
			
			'links' => [
				[
					'rel' => 'self',
					'href' => route('Users.show', $user->id),
				],
			],
        ];
    }
	
	public static function originalAttribute($index)
    {
        $attributes = [
            'identificador'=>'id',
            'nombre'=>'name',
			'usuario_psp'=>'user_psp',
            'correo' =>'email',
			'estado'=>'status',
			'cantidad'=>'credito',
            'esVerificado'=>'verified',
            'esAdministrador'=>'admin',
            'fechaCreacion'=>'created_at',
            'fechaActualizacion'=>'updated_at',
            'fechaEliminacion'=>'deleted_at',
			'fotoPerfil'=>'user_img_pr',
			'claveAcceso'=>'password',
        ];
		
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'name' => 'nombre',
			'user_psp'=>'usuario_psp',
            'email' => 'correo',
			'status'=>'estado',
			'credito'=>'cantidad',
            'verified' => 'esVerificado',
            'admin' => 'esAdministrador',
            'created_at' => 'fechaCreacion',
            'updated_at' => 'fechaActualizacion',
            'deleted_at' => 'fechaEliminacion',
			'user_img_pr'=>'fotoPerfil',
			'password'=>'claveAcceso',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
