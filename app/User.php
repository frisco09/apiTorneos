<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Support\Facades\Hash;
use App\Amistoso;
use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $dates =['delete_at'];
    const USUARIO_ACTIVO = "disponible";
    const USUARIO_INACTIVO = "no disponible";
    
    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';
	const USUARIO_BAJA = '-1';
	
    const USUARIO_ADMIN = 'true';
    const USUARIO_REGULAR = 'false';
	
	public $transformer = UserTransformer::class;
    
	protected $table = 'users';
    //protected $dates = ['deleted_at'];
	
    protected $fillable = [
        //'id'
        'user_psp',
        'name',
        'email', 
        'password',
        'status',
        'credito',
        'verified',
        'verification_token',
        'admin',
		'user_img_pr',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
	    'password',
        'remember_token',
        'verification_token',
    ];
	//
	//mutador pass
    public function setPasswordAttribute($valor)
    {
        $this->attributes['password'] = strtolower($valor);
    }
    public function getPasswordAttribute($valor)
    {
        return ucwords($valor);
    }
    //mutador name
    public function setNameAttribute($valor)
    {
        $this->attributes['name'] = strtolower($valor);
    }
    public function getNameAttribute($valor)
    {
        return ucwords($valor);
    }
	//mutador user_psp
    public function setUserPspAttribute($valor)
    {
        $this->attributes['user_psp'] = strtolower($valor);
    }
    public function getUserPspAttribute($valor)
    {
        return ucwords($valor);
    }
	//mutador email
	public function setEmailAttribute($valor)
    {
        $this->attributes['email'] = strtolower($valor);
    }
	public function getEmailAttribute($valor)
    {
        return ucwords($valor);
    }
	//mutador credito
	public function getCreditoAttribute($valor)
    {
        return ucwords($valor);
    }
	public function setCreditoAttribute($valor)
    {
        $this->attributes['credito'] = strtolower($valor);
    }
	//mutador foto
	public function getUserImgPrAttribute($valor)
    {
        return ucwords($valor);
    }
	public function setUserImgPrAttribute($valor)
    {
        $this->attributes['user_img_pr'] = strtolower($valor);
    }
    //user STATUS
    public function esta_disponible()
    {
        return $this->status == User::USUARIO_ACTIVO;
    }
	public function no_disponible()
    {
        return $this->status == User::USUARIO_INACTIVO;
    }
    //el perfil fue verificado con el token
    public function esVerificado()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }
    //user admin, un admin tiene funciones diferentes a un user regular
    public function esAdministrador()
    {
        return $this -> admin == User::USUARIO_ADMIN;
    }
	//USUARIO_BAJA
	public function isBann (){
		return $this-> status == User::USUARIO_BAJA;
	}
    //clave random para verificar email
    public static function generarVerificationToken()
    {
        return str_random(40);
    }

    //un usuario pertenece a un amistoso
    public function amistosoUsers()
    {
        return $this->belongsTo(Amistoso::class);
    }
	//pertenece a una salaUsers
	public function salaUsers(){
		return $this->belongsTo(Sala::class);
	}
	//user carga resultado
	public function resultadoUsers(){
		return $this->belongsTo(Resultado::class);
	}
	
	//user passport
	/*public function findForPassport($username)
	{
		return $this->where('email', $username)->first();
	}
	public function validateForPassportPasswordGrant($password)
	{
		return \Hash::check($password, $this->password);
	}
	public function setPasswordAttribute($value) {
		$this->attributes['password'] = Hash::make($value);
	}*/
}
