<?php

namespace App\Http\Controllers\FronEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

use App\User;
use App\Models\ProductRequest;

use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tag;

class LabelPdfController extends Controller
{
    public function printPdf()
    {

        $product = ProductRequest::where('send_status', '!=', 'Objeto entregado')
            ->where('label_printed', '!=', 'si')
            ->get([
                'id',
                'user_id',
                'user_name',
                'user_email',
                'user_cap',
                'user_direccion',
                'user_calle',
                'user_numero',
                'user_piso',
                'user_depto',
                'user_referencia',
                'user_localidad',
                'user_provincia',
                'request_track',
                'request_date',
                'request_status',
                'send_status',
                'send_date',
                'user_num_telf',
                'product_id',
                'product_name',
                'qnt_request'
            ]);


        if ($product->isNotEmpty()) {
            $pimaco = new Pimaco('6184');
            $tag = new Tag();

            foreach ($product as $prd) {

                ProductRequest::where('id',  $prd->id)->update([
                    'label_printed' => 'si',
                ]);

                $tag = new Tag();
                $tag->setPadding(8);
                $tag->img(asset("images/blogblack.png"))->setHeight(15)->setAlign('center')->setMargin(array(10, 23, 0, 20));
                $tag->p('')->br();
                $tag->p('')->br();
                $tag->p('')->br();
                $tag->p('')->br();
                $tag->p('')->br();
                $tag->p('')->br();
                $tag->p('')->br();
                $tag->p('')->br();
                $tag->p('DESTINATARIO: ')->setSize(4)->br();
                $tag->p('')->br();
                $tag->p($prd->user_name . ' , ' . $prd->user_email)->br();
                $tag->p($prd->user_calle . ' , ' . $prd->user_numero . ' , ' . $prd->user_direccion)->setSize(3)->br();
                $tag->p($prd->user_piso . ' , ' . $prd->user_referencia . ' , ' . $prd->user_localidad)->setSize(3)->br();
                $tag->p($prd->user_cap)->setSize(3)->br();
                $tag->setBorder(0);
                //$tag->p($prd->user_name)->br();
                $tag->setBorder(0);
                $pimaco->addTag($tag);
            }

            $pim = $pimaco->output();

            return $pim;
        } else {
            return back();
        }
    }
}
