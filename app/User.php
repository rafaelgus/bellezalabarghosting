<?php

namespace App;

use App\Models\Childs;
use App\Models\Address;
use App\Models\Profile;
use App\Models\UserSolar;
use App\Models\UserCuerpo;


use App\Models\UserRostro;
use App\Models\UserCapilar;
use App\Models\UserTintura;
use App\Models\UserProForma;
use App\Models\UserProSalon;
use App\Models\ProductRequest;
use App\Models\Review;
use App\Models\UserInfluencer;
use App\Models\UserMaquillaje;
use App\Models\UserProCapilar;
use App\Models\UserProTintura;
use App\Models\UserProMaquillaje;
use App\Models\UserProDecoloracion;
use App\Models\UserProIndependiente;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use CrudTrait;
    use HasRoles;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'users';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'sobre_nombre',
        'gusto_llamado',
        'profesional_belleza',
        'password',
        'numero_whatsapp',
        'rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function userCapilar()
    {
        return $this->hasOne(UserCapilar::class);
    }
    public function userTintura()
    {
        return $this->hasOne(UserTintura::class);
    }
    public function userCuerpo()
    {
        return $this->hasOne(UserCuerpo::class);
    }
    public function userMaquillaje()
    {
        return $this->hasOne(UserMaquillaje::class);
    }
    public function userRostro()
    {
        return $this->hasOne(UserRostro::class);
    }
    public function userSolar()
    {
        return $this->hasOne(UserSolar::class);
    }
    public function userchilds()
    {
        return $this->hasOne(Childs::class);
    }
    public function userInfluencer()
    {
        return $this->hasOne(UserInfluencer::class);
    }

     public function userAddres()
    {
        return $this->hasOne(Address::class)->where('modelo', 'add');
    }

    public function userAlternativeAddres()
    {
        return $this->hasOne(Address::class)->where('modelo', 'aadd');
    }
    public function userSalonAddres()
    {
        return $this->hasOne(Address::class)->where('modelo', 'sadd');
    }
    public function userProCapilar()
    {
        return $this->hasOne(UserProCapilar::class);
    }

    public function userProDecoloration()
    {
        return $this->hasOne(UserProDecoloracion::class);
    }
    public function userProForma()
    {
        return $this->hasOne(UserProForma::class);
    }

    public function userProMaquillaje()
    {
        return $this->hasOne(UserProMaquillaje::class);
    }

     public function userProIndependiente()
    {
        return $this->hasOne(UserProIndependiente::class);
    }

    public function userProSalon()
    {
        return $this->hasOne(UserProSalon::class);
    }
    public function userProTintura()
    {
        return $this->hasOne(UserProTintura::class);
    }

    public function productRequest()
    {
        return $this->hasMany(ProductRequest::class);
    }

    public function productReview()
    {
        return $this->hasMany(Review::class);
    }




    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeHombre($q)
    {
        $sex = 'Homem';
        $textSex = $this->with(['perfil'])
            ->whereHas('perfil', function ($q) use ($sex) {
                $q->where('sexo', $sex);
            })->get();
            //dd($textSex);
        return $textSex;
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */








}
