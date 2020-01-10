<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class productRequestDetailsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductRequestDetailsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $product_id = \Route::current()->parameter('product_id');

        $this->crud->setModel('App\Models\ProductRequest');

        $this->crud->setRoute(config('backpack.base.route_prefix') . '/productrequest/'. $product_id . '/productrequestdetails');
        $this->crud->setEntityNameStrings('solicitud de producto', 'solicitud de productos');

        $this->crud->addButtonFromView('top', 'back_to_request', 'back_to_request', 'end');

        $this->crud->enableExportButtons();

        //$this->crud->groupBy('product_name');
        $this->crud->addClause('where', 'product_id', $product_id);
        $this->crud->addClause('where', 'request_status', '=' ,'Enviada');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'user_name',
            'label' => 'Usuario',
        ]);
        $this->crud->addColumn([
            'name' => 'user_email',
            'label' => 'Correo Electronico',
        ]);

        $this->crud->addColumn([
            'name' => 'user_cap',
            'label' => 'CAP',
        ]);
        $this->crud->addColumn([
            'name' => 'user_localidad',
            'label' => 'Localidad',
        ]);
        $this->crud->addColumn([
            'name' => 'user_provincia',
            'label' => 'Provincia',
        ]);
        $this->crud->addColumn([
            'name' => 'request_status',
            'label' => 'Status',
        ]);
        $this->crud->addColumn([
            'name' => 'send_status',
            'label' => 'Estatus del Envio',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(productRequestRequest::class);

        $this->crud->addField([    // TEXT
            'name' => 'product_name',
            'label' => 'Producto Solicitado',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'readonly' => 'readonly',
            'attributes' => ['disabled' => 'disabled'],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'user_email',
            'label' => 'Email del usuario',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'user_num_telf',
            'label' => 'Numero Telefonico',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'user_cap',
            'label' => 'CAP',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'user_direccion',
            'label' => 'Direccion',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'user_calle',
            'label' => 'Calle',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'user_numero',
            'label' => 'Numero',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'user_piso',
            'label' => 'Piso',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);

        $this->crud->addField([    // TEXT
            'name' => 'user_depto',
            'label' => 'Depto',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);

        $this->crud->addField([    // TEXT
            'name' => 'user_referencia',
            'label' => 'Referencia ',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);

        $this->crud->addField([    // TEXT
            'name' => 'user_localidad',
            'label' => 'Localidad ',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);

        $this->crud->addField([    // TEXT
            'name' => 'user_provincia',
            'label' => 'Provincia ',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);


        $this->crud->addField([    // TEXT
            'name' => 'created_at',
            'label' => 'Solicitado el:',
            'type' => 'date',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'request_track',
            'label' => 'Cod Traking',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            //'attributes' => ['disabled' => 'disabled'],
            /* 'placeholder' => 'Coloca el nombre del producto aqui',
            'tab' => 'General', */
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'send_date',
            'label' => 'Recibido el:',
            'type' => 'date',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);

        $this->crud->addField([    // TEXT
            'name' => 'request_status',
            'label' => 'Status',
            'type' => 'select_from_array',
            'options' => ['En tramite' => 'En tramite', 'Aprobada' => 'Aprobada', 'Enviada' => 'Enviada', 'Rechazada' => 'Rechazada'],
            'allows_null' => false,
            'default' => 'En tramite',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],

        ]);
        $this->crud->addField([    // TEXT
            'name' => 'send_status',
            'label' => 'Estado del envio',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['disabled' => 'disabled'],

        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
