<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRestrictionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductRestrictionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductRestrictionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ProductRestriction');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/productrestriction');
        $this->crud->setEntityNameStrings('restriccion', 'restricciones');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn([
            // 1-n relationship
            'label' => "Producto", // Table column heading
            'type' => "select",
            'name' => 'product_id', // the column that contains the ID of that connected entity;
            'entity' => 'product', // the method that defines the relationship in your Model
            'attribute' => "title", // foreign key attribute that is shown to user
            'model' => "App\Models\Product", // foreign key model
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRestrictionRequest::class);

        $this->crud->addField([    // SELECT
            'label' => 'Producto',
            'type' => 'select',
            'name' => 'product_id', // the db column for the foreign key
            'entity' => 'product', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => "App\Models\Product",
            'allows_null' => true,
            //'tab' => 'Detalles',
            'tab' => 'Producto',
            'options'   => (function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([

            'name' => 'sexo',
            'label' => "Solo para usuarios con este genero:",
            'type' => 'select_from_array',
            'options' => [

                'Homem' => 'Hombre',
                'Mulher' => 'Mujer',
                'Otro' => 'Otro'
            ],
            'allows_null' => true,
            //'default' => ' ',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Generales',
        ]);
        $this->crud->addField([
            'name' => 'rangoEdadInicio',
            'label' => 'Edad Inicial',
            'type' => 'number',
            // optionals
            // 'attributes' => ["step" => "any"], // allow decimals
            // 'prefix' => "$",
            // 'suffix' => ".00",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],

            'tab' => 'Generales',
        ]);
        $this->crud->addField([
            'name' => 'rangoEdadFin',
            'label' => 'Edad Final',
            'type' => 'number',
            // optionals
            // 'attributes' => ["step" => "any"], // allow decimals
            // 'prefix' => "$",
            // 'suffix' => ".00",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],

            'tab' => 'Generales',
        ]);
      /*   $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => 'Localidad',
            'type' => 'select2_multiple',
            'name' => 'localidades', // the method that defines the relationship in your Model
            'entity' => 'localidades', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Tag", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'tab' => 'Detalles',
            'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
             }),
        ]); */
        $this->crud->addField([
            'label' => "Localidad",
            'name' => 'ciudad',
            'type' => 'select_from_array',
            'options' => [


            ],
            'allows_null' => true,
            //'default' => ' ',
            // 'allows_multiple' =>  true/
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],

            'tab' => 'Generales',
        ]);

        $this->crud->addField([
            'label' => "Estado",
            'name' => 'estado',
            'type' => 'select_from_array',
            'options' => [


            ],
            'allows_null' => true,
            //'default' => ' ',
            // 'allows_multiple' =>  true/
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],

            'tab' => 'Generales',
        ]);
        $this->crud->addField([

            'name' => 'cabelloTipo',
            'label' => "Solo para usuarios con  este tipo de cabello:",
            'type' => 'select_from_array',
            'options' => [
                'Liso' => 'Liso',
                'Alisado' => 'Alisado',
                'Ondulado' => 'Ondulado',
                'Rulos' => 'Rulos',
                'Crespo' => ' Crespo'
            ],
            'allows_null' => true,
            //'default' => ' ',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Generales',
        ]);

        $this->crud->addField([

            'name' => 'tinturaUso',
            'label' => "Usuarios que usen tinturas para el cabello:",
            'type' => 'select_from_array',
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ],
            'allows_null' => true,
            //'default' => 'Si',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Tinturas',
        ]);
        $this->crud->addField([

            'name' => 'cabellocolNatural',
            'label' => "Solo para usuarios que tengan color de cabello natural:",
            'type' => 'select_from_array',
            'options' => [
                'Negro' => 'Negro',
                'Castaño' => 'Castaño',
                'Rubio' => 'Rubio',
                'Rojo' => 'Rojo'
            ],
            'allows_null' => true,
            //'default' => 'Negro',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Tinturas',
        ]);

        $this->crud->addField([

            'name' => 'cabellocolActual',
            'label' => "Solo para usuarios que tengan color de cabello tintado:",
            'type' => 'select_from_array',
            'options' => [
                'Negro' => 'Negro',
                'Castaño' => 'Castaño',
                'Rubio' => 'Rubio',
                'Rojo' => 'Rojo'
            ],
            'allows_null' => true,
            'default' => 'Negro ',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Tinturas',
        ]);
        $this->crud->addField([

            'name' => 'rostroUso',
            'label' => "Solo para usuarios que usen productos para cuidado del rostro:",
            'type' => 'select_from_array',
            'options' => [
                'si' => 'Si',
                'no' => 'No'

            ],
            'allows_null' => true,
            'default' => 'Si',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Rostro',
        ]);

        $this->crud->addField([

            'name' => 'cremaCuerpo',
            'label' => "Solo para usuarios que usen  cremas corporales:",
            'type' => 'select_from_array',
            'options' => [
                'si' => 'Si',
                'no' => 'No'

            ],
            'allows_null' => true,
            'default' => 'Si',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Cuerpo',
        ]);
        $this->crud->addField([

            'name' => 'solarUso',
            'label' => "Solo para usuarios que usen protector solar:",
            'type' => 'select_from_array',
            'options' => [
                'si' => 'Si',
                'no' => 'No'

            ],
            'allows_null' => true,
            'default' => ' ',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Protector',
        ]);
        $this->crud->addField([

            'name' => 'maquillajeUso',
            'label' => "Solo para usuarios que usen maquillaje:",
            'type' => 'select_from_array',
            'options' => [
                'si' => 'Si',
                'no' => 'No'

            ],
            'allows_null' => true,
            'default' => ' ',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            'tab' => 'Maquillaje',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
