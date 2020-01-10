<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Product;
use App\Models\ProductRequest;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];
        $this->data['prdreq'] = ProductRequest::all()->count();


        $this->data['products'] = Product::all()->count();
        $this->data['testers'] = User::where('profesional_belleza', '!=', '')->count();
        $this->data['users'] = User::all()->count();
        $this->data['prdreqdispatch'] = ProductRequest::where('request_status', 'Enviada')->count();
        $this->data['prdreqsend'] = ProductRequest::where('request_status', 'En Proceso')->count();





        $this->data['widgets']['before_content']=[
            [
                'type' => 'div',
                'class' => 'row',
                'content' => [ // widgets
                    [
                        'type'        => 'progress',
                        'class'       => 'card text-white bg-warning mb-2',
                        'value'       => $this->data['testers'] ,
                        'description' => 'Testers.',
                        'hint'        => '',
                        'icon'        => 'las la-user-plus',
                        'button_text' => trans('backpack::base.logout'),
                        'footer_link' => '/admin/user',
                        'footer_text' => 'Ver usuarios'
                    ],
                    [
                        'type'        => 'progress',
                        'class'       => 'card text-white bg-info mb-2',
                        'value'       => $this->data['products'],
                        'description' => 'Productos.',
                        'hint'        => '',
                        'icon'        => 'las la-store',
                        'button_text' => trans('backpack::base.logout'),
                        'footer_link' => '/admin/product',
                        'footer_text' => 'Ver los productos'
                    ],
                    [
                        'type'        => 'progress',
                        'class'       => 'card text-white bg-primary mb-2',
                        'value'       => $this->data['prdreq'],
                        'description' => 'Solicitudes.',
                        'hint'        => '',
                        'icon'        => 'las la-truck',
                        'button_text' => trans('backpack::base.logout'),
                        'footer_link' => '/admin/productrequest',
                        'footer_text' => 'Ver las solicitudes'
                    ],
                    [
                        'type'        => 'progress',
                        'class'       => 'card text-white bg-success mb-2',
                        'value'       => $this->data['prdreqdispatch'],
                        'description' => 'Solicitudes Enviadas',
                        'hint'        => '',
                        'icon'        => 'las la-tasks',
                        'button_text' => trans('backpack::base.logout'),
                        'footer_link' => '/admin/productrequest',
                        'footer_text' => 'Ver las solicitudes '
                    ],
                    [
                        'type'        => 'progress',
                        'class'       => 'card text-white bg-danger mb-2',
                        'value'       => $this->data['prdreqsend'],
                        'description' => 'Solicitudes por enviar',
                        'hint'        => '',
                        'icon'        => 'lab la-telegram-plane',
                        'button_text' => trans('backpack::base.logout'),
                        'footer_link' => '/admin/productrequest',
                        'footer_text' => 'Ver las solicitudes '
                    ],


                ]
              ]
        ];

        return view(backpack_view('dashboard'), $this->data);
    }

     /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(backpack_url('dashboard'));
    }
}
