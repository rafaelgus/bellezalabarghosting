<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class ProductRestriction extends Model
{
    use CrudTrait;
   /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'product_restrictions';
     protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [

            'sexo',
            'rangoEdadInicio',
            'rangoEdadFin',
            'estado_id',
            'ciudad_id',
            'cabelloTipo',
            'cremaCuerpo',
            'maquillajeUso',
            'rostroUso',
            'solarUso',
            'tinturaUso',
            'cabellocolNatural',
            'cabellocolActual',
            'product_id'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    protected $casts = [
        'ciudad_id'=> 'array',
        'estado_id' => 'array'

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

     public function product()
    {
        return $this->belongsTo(Product::class);
    }





    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */



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
