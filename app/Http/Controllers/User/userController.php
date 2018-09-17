<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use App\Transformers\UserTransformer;
//use App\Mail\UserCreated;
//use Illuminate\Support\Facades\Mail;

class userController extends ApiController
{
	public function __construct()
    {
		parent::__construct();
        //$this->middleware('client.credentials')->only(['store', 'resend']);
        //$this->middleware('auth:api')->except(['store', 'verify', 'resend']);
        $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);
        //$this->middleware('scope:manage-account')->only(['show', 'update']);
        //$this->middleware('can:view,user')->only('show');
        //$this->middleware('can:update,user')->only('update');
        //$this->middleware('can:delete,user')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
        //return $usuarios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'=>'required',
            'email' =>'required|email|unique:users',
			'password'=>'required|min:6',
			'user_psp'=>'required|unique:users'
        ];
        $this->validate($request,$rules);
        $campos = $request->all();
        $campos ['password'] = bcrypt($request->password);
        $campos ['status'] = User::USUARIO_INACTIVO;
        $campos ['verified'] = User::USUARIO_NO_VERIFICADO;
        $campos ['verification_token'] = User::generarVerificationToken();
        $campos ['admin'] = User::USUARIO_REGULAR;
		$campos ['user_img_pr'] = $request->fotoPerfil->store('');

        $user = User::create($campos);
        return $this->showOne($user);
    }

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		//return $this->showOne($user);
        /*$usuario = User::findOrFail($id);
        return response()->json(['data' => $usuario],200);*/
		$user = User::findOrFail($id);
		return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$user = User::findOrFail($id);	
        $reglas = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6',
            'admin' => 'in:' . User::USUARIO_ADMIN . ',' . User::USUARIO_REGULAR,
        ];
        $this->validate($request, $reglas);
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USUARIO_NO_VERIFICADO;
            $user->verification_token = User::generarVerificationToken();
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
		//----------------------------------------------------------------
		if($request->has('status')){
			$state = $request->status;
			
			if($state==$user->no_disponible()){
				$user->status = User::USUARIO_ACTIVO;
			}
			else
				if($state==$user->esta_disponible()){
					$user->status = User::USUARIO_INACTIVO;
			}
		}
		//----------------------------------------------------------------
        if ($request->has('admin')) {
            if (!$user->esVerificado()) {
                return $this->errorResponse('Unicamente los usuarios verificados pueden cambiar su valor de administrador', 409);
            }
            $user->admin = $request->admin;
        }
        if (!$user->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = User::findOrFail($id);
        $user->delete();
        return $this->showOne($user);
    }
    public function verify($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();
        $user->verified = User::USUARIO_VERIFICADO;
        $user->verification_token = null;
        $user->save();
        return $this->showMessage('La cuenta ha sido verificada');
    }
    public function resend(User $user)
    {
        if ($user->esVerificado()) {
            return $this->errorResponse('Este usuario ya ha sido verificado.', 409);
        }
        retry(5, function() use ($user) {
            Mail::to($user)->send(new UserCreated($user));
        }, 100);
        return $this->showMessage('El correo de verificación se ha reenviado');
    }
}
/*
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return response()->json(['data' => $usuario],200);
    }
	
	public function show(User $user)
    {
        return $this->showOne($user);
        
    }
	    
*/