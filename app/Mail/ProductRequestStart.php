<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\ProductRequest;

class ProductRequestStart extends Mailable
{
    use Queueable, SerializesModels;
    public $productRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProductRequest $productRequest )
    {
        $this->productRequest = $productRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.requests.request')->subject('Análise de pedido ');
    }
}
