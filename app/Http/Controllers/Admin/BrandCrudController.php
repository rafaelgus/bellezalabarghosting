<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BrandCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BrandCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Brand');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/brand');
        $this->crud->setEntityNameStrings('marca', 'marcas');

        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('name', 2);
    }

    protected function setupListOperation()
    {

        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();


        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
        ]);
        $this->crud->addColumn([
            'label' => 'Padre',
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => "App\Models\Brand",
        ]);
        $this->crud->addColumn([
            'label' => 'Imagen',
            'type' => 'image',
            'name' => 'image',
            'height' => '100px',
            'width' => '100px',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BrandRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'name',
            'label' => 'Nombre',
        ]);
        $this->crud->addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Se generará automáticamente a partir de su nombre, si se deja vacío.',
            'readonly' => 'readonly',
            // 'disabled' => 'disabled'
        ]);
        $this->crud->addField([
            'label' => 'Padre',
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => "App\Models\Brand",
        ]);
        $this->crud->addField([
            'label' => 'Imagen',
            'type' => 'image',
            'name' => 'image',
            'upload' => true,
            'crop' => true,
            'aspect_ratio' => 0
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
