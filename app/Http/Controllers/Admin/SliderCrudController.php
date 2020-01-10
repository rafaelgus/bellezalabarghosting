<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SliderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SliderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Slider');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/slider');
        $this->crud->setEntityNameStrings('slider', 'sliders');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'image', // The db column name
            'label' => "Imagen", // Table column heading
            'type' => 'image',
                // 'prefix' => 'folder/subfolder/',
                // optional width/height if 25px is not ok with you
                'height' => '150px',
                'width' => '100px',
        ]);
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Titulo',
        ]);
        $this->crud->addColumn([
            'name' => 'subtitle',
            'label' => 'SubTitulo',
        ]);
        $this->crud->addColumn([
            'name' => 'url',
            'label' => 'URL',
        ]);
        $this->crud->addColumn([
            'name' => 'is_mobile',
            'label' => 'Mobil',
            
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SliderRequest::class);

        $this->crud->addField([ // image
            'label' => "Imagen",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);
         $this->crud->addField([
        'name' => 'title',
        'label' => 'Titulo',
        ]);
         $this->crud->addField([
        'name' => 'subtitle',
        'label' => 'SubTitulo',
        ]);
         $this->crud->addField([
          // URL
        'name' => 'url',
        'label' => 'Link del Slider',
        'type' => 'url'

        ]);
        $this->crud->addField([
            // URL
          'name' => 'is_mobile',
          'label' => 'Imagen para dispositivos mobiles',
          'type' => 'checkbox'

          ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
