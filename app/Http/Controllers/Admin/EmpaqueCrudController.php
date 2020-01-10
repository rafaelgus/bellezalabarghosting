<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmpaqueRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmpaqueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EmpaqueCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Empaque');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/empaque');
        $this->crud->setEntityNameStrings('empaque', 'empaques');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'tipo',
            'label' => 'Tipo',
        ]);
        $this->crud->addColumn([
            'name' => 'empaque',
            'label' => 'Descripcion',
            'type' => 'table',
            'columns' => [
                'alto' => 'Alto',
                'ancho' => 'Ancho',
                'largo' => 'Largo',
                'peso' => 'Peso'
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(EmpaqueRequest::class);

        $this->crud->addField([
            'name' => 'tipo',
            'label' => 'Tipo',
            'type' => 'text',
        ]);
        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'empaque',
            'label' => 'Especificacion',
            'type' => 'table',
            'entity_singular' => 'opcion', // used on the "Add X" button
            'columns' => [
                'alto' => 'Alto',
                'ancho' => 'Ancho',
                'largo' => 'Largo',
                'peso' => 'Peso'
            ],
            'max' => 1, // maximum rows allowed in the table
            'min' => 0, // min
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => 'tipo',
            'label' => 'Tipo',
        ]);
        $this->crud->addColumn([
            'name' => 'empaque',
            'label' => 'Descripcion',
            'type' => 'table',
            'columns' => [
                'alto' => 'Alto',
                'ancho' => 'Ancho',
                'largo' => 'Largo',
                'peso' => 'Peso'
            ],
        ]);
    }
}
