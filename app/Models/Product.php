<?php

namespace App\Models;

use App\Models\Poll;
use App\Models\Review;
use App\Models\ProductRequest;
use App\Models\ProductRestriction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Product extends Model
{

    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'brand_id',
        'poll_id',
        'empaque_id',
        'attributes',
        'how_to',
        'slug',
        'general_reviews',
        'count_total_reviews',
        'description',
        'stock',
        'image',
        'status',
        'date',
        'featured',

    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'featured'  => 'boolean',
        'date'      => 'date',
        'attributes' => 'array',
        'how_to'    => 'array',
    ];

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getStarRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $starCountSum = $this->reviews()->sum('general_rating');
        $average = $starCountSum / $count;

        return $average;

    }

    public function getStarCount()
    {
        $count = $this->reviews()->where('aproved', 1)->count();
        if (empty($count)) {
            return 0;
        }

        return $count;

    }

    public function getPresentacionRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $presentacionCountSum = $this->reviews()->sum('presentacion');
        $average_presentacion = $presentacionCountSum / $count;

        return $average_presentacion ;

    }

     public function getAromaRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $aromaCountSum = $this->reviews()->sum('aroma');
        $average_aroma = $aromaCountSum / $count;

        return $average_aroma;

    }

     public function getTexturaRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $texturaCountSum = $this->reviews()->sum('textura');
        $average_textura = $texturaCountSum / $count;

        return $average_textura ;

    }

     public function getDurabilidadRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $durabilidadCountSum = $this->reviews()->sum('durabilidad');
        $average_durabilidad = $durabilidadCountSum / $count;

        return $average_durabilidad;

    }

     public function getFacilidadRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $facilidadCountSum = $this->reviews()->sum('fac_uso');
        $average_facilidad = $facilidadCountSum / $count;

        return $average_facilidad;

    }

       public function getEficaciaRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $eficaciaCountSum = $this->reviews()->sum('eficacia');
        $average_eficacia = $eficaciaCountSum / $count;

        return $average_eficacia ;

    }
    public function getComprariaRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $eficaciaCountSum = $this->reviews()->sum('compraria');
        $average_eficacia = $eficaciaCountSum / $count;

        return $average_eficacia ;

    }

       public function getCalidadRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $calidadCountSum = $this->reviews()->sum('calidad_precio');
        $average_calidad = $calidadCountSum / $count;

        return $average_calidad ;

    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function empaque()
    {
        return $this->belongsTo(Empaque::class);
    }

    public function requestRestriction()
    {
        return $this->hasOne(ProductRestriction::class);

    }

    public function productRequest()
    {
        return $this->belongsTo(ProductRequest::class);
    }



    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopePublished($query)
    {
        return $query->where('status', 'Publicado')
                    ->where('date', '<=', date('Y-m-d'))
                    ->orderBy('date', 'DESC');
    }

    public function scopeProductStock($query)
    {

        $product = $this->with(['tags', 'categories', 'brand', 'poll', 'requestRestriction'])
                    ->where('status', 'PUBLICADO')
                    ->paginate(6);
        return  $product;


    }

    public function scopeProductRestricted($q)
    {
        $sex = Auth::user()->perfil->sexo;
        $age = Auth::user()->perfil->edad;

        $textSex = $this->with(['requestRestriction'])
            ->where('stock', '>=', 1)
            ->whereHas('requestRestriction', function ($q) use ($age) {
                $q
                ->where('rangoEdadInicio', '<', $age)
                ->where('rangoEdadFin', '>', $age)
                ->orWhereNull('rangoEdadInicio')
                ->orWhereNull('rangoEdadFin');
            })
            ->whereHas('requestRestriction', function ($q) use ($sex) {
                $q
                ->where('sexo', $sex)
                ->orWhereNull('sexo');
            })->get();
            //dd($textSex);
        return $textSex;
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "product";
        $destination_path = "uploads/images/product";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->resize(300,300)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }
    }
}
