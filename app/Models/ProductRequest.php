<?php

namespace App\Models;

use App\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;


class ProductRequest extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $status = 'objeto entregado';

    protected $table = 'product_requests';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_cap',
        'user_direccion',
        'user_calle',
        'user_numero',
        'user_piso',
        'user_depto',
        'user_referencia',
        'user_localidad',
        'user_provincia',
        'request_track',
        'request_date',
        'request_status',
        'send_status',
        'send_date',
        'user_num_telf',
        'product_id',
        'product_name',
        'qnt_request'
    ];
    // protected $hidden = [];
    protected $dates = [
        'send_date',
        'request_date'
    ];

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
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeProductForReview($q)
    {
        $user_id = Auth::user()->id;

        $productTest = $this->where('user_id', $user_id)
            ->where(function ($query) {
                $query->where('send_status', 'objeto entregado')
                    ->where('review_completed', '!=', 'si');
            })
            ->first();

        if ($productTest == null) {
            return false;
        }

        return $productTest;
    }

    public function scopeUserRequest($q)
    {
        $userRequest = $this->where('send_status', 'objeto entregado')
            ->where(function ($query) {
                $query->where('review_completed', 'no');
            })
            ->get();

        return $userRequest;
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getAllRequestCount()
    {
        return $this->count();
    }
    public function getRequestCount()
    {
        return self::where([['product_id', $this->product_id],])
            ->get()
            ->count();
    }
    public function getRequestSendCount()
    {
        return self::where('product_id', $this->product_id)
            ->where('request_status', 'Enviada')
            ->get()
            ->count();
    }

    public function getRequestForSendCount()
    {
        return self::where('product_id', $this->product_id)
            ->where('request_status', '!=', 'Enviada')
            ->get()
            ->count();
    }

    public function getRequestReviewCount()
    {
        return self::where('product_id', $this->product_id)
            ->where('review_completed', 'si')
            ->get()
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
   |--------------------------------------------------------------------------
    */
}
