<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductRestriction;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings('producto', 'productos');
        $this->crud->setSubheading('', 'create');






    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Nombre',
        ]);
        $this->crud->addColumn([
            'name' => 'brand.name',
            'label' => 'Marca',
        ]);
        $this->crud->addColumn([
            'label' => "Categorias", // Table column heading
            'type' => "select_multiple",
            'name' => 'categories', // the method that defines the relationship in your Model
            'entity' => 'categories', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Category", // foreign key model
        ]);


         $this->crud->addColumn([
            'label' => 'Imagen',
            'type' => 'image',
            'name' => 'image',
            'height' => '100px',
            'width' => '100px',
        ]);

        $this->crud->addColumn([
            'name' => 'stock',
            'label' => 'Stock',
            'type' => "number",
            // 'prefix' => "$",
            // 'suffix' => " EUR",
             'decimals' => 2,
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Estado',

        ]);
        $this->crud->addColumn([
            'name' => 'featured', // The db column name
            'label' => "Destacado", // Table column heading
            'type'        => 'radio',
            'options'     => [
                        0 => "No",
                        1 => "Si"
                    ]
        ]);
           $this->crud->addColumn([
            'name' => 'poll_id',
            'label' => 'Encuesta',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);

        $this->crud->addField([    // TEXT
            'name' => 'title',
            'label' => 'Nombre',
            'type' => 'text',
            'placeholder' => 'Coloca el nombre del producto aqui',
            'tab' => 'General',
        ]);
        $this->crud->addField([    // WYSIWYG
            'name' => 'description',
            'label' => 'Descripcion',
            'type' => 'textarea',
            'placeholder' => 'Para ser usado en la descripcion',
            'tab' => 'General',
        ]);
        $this->crud->addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Se generará automáticamente a partir de su título, si se deja vacío.',
            'disabled' => 'disabled',
            'readonly'=>'readonly',
            'tab' => 'General',
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
            'value' => date('d-m-Y'),
            'language' => 'es',
            'tab' => 'General',
        ], 'create');
        $this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Fecha',
            'type' => 'date',
            'tab' => 'General',
        ], 'update');
        $this->crud->addField([    // ENUM
            'name' => 'status',
            'label' => 'Estado',
            'type' => 'enum',
            'tab' => 'General',
        ]);
        $this->crud->addField([    // CHECKBOX
            'name' => 'featured',
            'label' => 'Destacado',
            'type' => 'checkbox',
            'tab' => 'General',
        ]);


        $this->crud->addField([    // Image
            'name' => 'image',
            'label' => 'Imagen',
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0,
            'tab' => 'Imagen',
        ]);
        $this->crud->addField([    // SELECT
            'label' => 'Marca',
            'type' => 'select2',
            'name' => 'brand_id', // the db column for the foreign key
            'entity' => 'brand', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Brand",
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        }),
        ]);
        $this->crud->addField([    // SELECT
            'label' => 'Categoria',
            'type' => 'select2_multiple',
            'name' => 'categories',
            'entity' => 'categories',
            'attribute' => 'name',
            'model' => "App\Models\Category",
            'pivot' => true,
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        }),
        ]);
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => 'Etiquetas',
            'type' => 'select2_multiple',
            'name' => 'tags', // the method that defines the relationship in your Model
            'entity' => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Tag", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
             }),
        ]);

        $this->crud->addField([
             'name' => 'stock',
            'label' => 'Stock',
            'type' => 'number',
            // optionals
             'attributes' => ["step" => "any"], // allow decimals
            // 'prefix' => "$",
            // 'suffix' => ".00"

            'tab' => 'Detalles',
        ]);
         $this->crud->addField([    // SELECT
            'label' => 'Encuesta',
            'type' => 'select',
            'name' => 'poll_id', // the db column for the foreign key
            'entity' => 'poll', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Poll",
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        }),
        ]);
        $this->crud->addField([    // SELECT
            'label' => 'Empaque',
            'type' => 'select2',
            'name' => 'empaque_id', // the db column for the foreign key
            'entity' => 'empaque', // the method that defines the relationship in your Model
            'attribute' => 'tipo', // foreign key attribute that is shown to user
            'model' => "App\Models\Empaque",
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('tipo', 'ASC')->get();
        }),
        ]);

        $this->crud->addField([// Table
            'name' => 'attributes',
            'label' => 'Atributos',
            'type' => 'table',
            'entity_singular' => 'atributo', // used on the "Add X" button
            'columns' => [
                'name' => 'Nombre',
                'desc' => 'Valor',

            ],
            'max' => 10, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table

            'tab' => 'Detalles',

        ]);
        $this->crud->addField([// Table
            'name' => 'how_to',
            'label' => 'Como y para que Usarlo',
            'type' => 'table',
            'entity_singular' => 'Uso', // used on the "Add X" button
            'columns' => [
                'name' => 'Nombre',
                'desc' => 'Descripcion',

            ],
            'max' => 10, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table

            'tab' => 'Detalles',

        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);



        $this->crud->addField([    // TEXT
            'name' => 'title',
            'label' => 'Nombre',
            'type' => 'text',
            'placeholder' => 'Coloca el nombre del producto aqui',
            'tab' => 'General',
        ]);
        $this->crud->addField([    // WYSIWYG
            'name' => 'description',
            'label' => 'Descripcion',
            'type' => 'textarea',
            'placeholder' => 'Para ser usado en la descripcion',
            'tab' => 'General',
        ]);
        $this->crud->addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Se generará automáticamente a partir de su título, si se deja vacío.',
            'disabled' => 'disabled',
            'readonly'=>'readonly',
            'tab' => 'General',
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
            'language' => 'es',
            'tab' => 'General',
        ], 'create');
        $this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Fecha',
            'type' => 'date',
            'tab' => 'General',
        ], 'update');
        $this->crud->addField([    // ENUM
            'name' => 'status',
            'label' => 'Estado',
            'type' => 'enum',
            'tab' => 'General',
        ]);
        $this->crud->addField([    // CHECKBOX
            'name' => 'featured',
            'label' => 'Destacado',
            'type' => 'checkbox',
            'tab' => 'General',
        ]);


        $this->crud->addField([    // Image
            'name' => 'image',
            'label' => 'Imagen',
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0,
            'tab' => 'Imagen',
        ]);
        $this->crud->addField([    // SELECT
            'label' => 'Marca',
            'type' => 'select2',
            'name' => 'brand_id', // the db column for the foreign key
            'entity' => 'brand', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Brand",
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        }),
        ]);
        $this->crud->addField([    // SELECT
            'label' => 'Categoria',
            'type' => 'select2_multiple',
            'name' => 'categories',
            'entity' => 'categories',
            'attribute' => 'name',
            'model' => "App\Models\Category",
            'pivot' => true,
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        }),
        ]);
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => 'Etiquetas',
            'type' => 'select2_multiple',
            'name' => 'tags', // the method that defines the relationship in your Model
            'entity' => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Tag", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
             }),
        ]);

        $this->crud->addField([
             'name' => 'stock',
            'label' => 'Stock',
            'type' => 'number',
            // optionals
             'attributes' => ["step" => "any"], // allow decimals
            // 'prefix' => "$",
            // 'suffix' => ".00"

            'tab' => 'Detalles',
        ]);
         $this->crud->addField([    // SELECT
            'label' => 'Encuesta',
            'type' => 'select',
            'name' => 'poll_id', // the db column for the foreign key
            'entity' => 'poll', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Poll",
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        }),
        ]);
        $this->crud->addField([    // SELECT
            'label' => 'Empaque',
            'type' => 'select2',
            'name' => 'empaque_id', // the db column for the foreign key
            'entity' => 'empaque', // the method that defines the relationship in your Model
            'attribute' => 'tipo', // foreign key attribute that is shown to user
            'model' => "App\Models\Empaque",
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('tipo', 'ASC')->get();
        }),
        ]);

        $this->crud->addField([// Table
            'name' => 'attributes',
            'label' => 'Atributos',
            'type' => 'table',
            'entity_singular' => 'atributo', // used on the "Add X" button
            'columns' => [
                'name' => 'Nombre',
                'desc' => 'Valor',

            ],
            'max' => 10, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table

            'tab' => 'Detalles',

        ]);
        $this->crud->addField([// Table
            'name' => 'how_to',
            'label' => 'Como y para que Usarlo',
            'type' => 'table',
            'entity_singular' => 'Uso', // used on the "Add X" button
            'columns' => [
                'name' => 'Nombre',
                'desc' => 'Descripcion',

            ],
            'max' => 10, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table

            'tab' => 'Detalles',

        ]);

        //dd($this->crud->request->stock);
        if (!empty($this->crud->request->stock) ) {


            $product_id = $this->crud->request->id;

            $restrictioncheck = DB::table('product_restrictions')->where('product_id', $product_id)->count();

            if (!$restrictioncheck  > 0) {

                ProductRestriction::create([
                    'product_id' => $product_id,
                ]);
            }

        }

    }
}
