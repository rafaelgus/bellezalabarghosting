<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductRequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductRequestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\ProductRequest');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/productrequest');
        $this->crud->setEntityNameStrings('producto solicitado', 'productos solicitados');

        $this->crud->addButtonFromView('line', 'requestdetails', 'requestdetails', 'beginning');
        $this->crud->addButtonFromView('line', 'requestforsend', 'requestforsend', 'end');

        $this->crud->enableExportButtons();
        $this->crud->groupBy('product_name');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn([
            'name' => 'product_name',
            'label' => 'Producto ',
        ]);
        $this->crud->addColumn([
            'name' => 'request',
            'label' => 'Solicitudes Totales',
            'type' => 'model_function',
            'function_name' => 'getRequestCount'
        ]);

        $this->crud->addColumn([
            'name' => 'enviadas',
            'label' => 'Enviadas',
            'type' => 'model_function',
            'function_name' => 'getRequestSendCount'
        ]);

        $this->crud->addColumn([
            'name' => 'porEnviar',
            'label' => 'Por enviar',
            'type' => 'model_function',
            'function_name' => 'getRequestForSendCount'
        ]);

        $this->crud->addColumn([
            'name' => 'reviews',
            'label' => 'Review Completada',
            'type' => 'model_function',
            'function_name' => 'getRequestReviewCount'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequestRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
