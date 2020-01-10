<a href="{{ route('productrequest.index')}}" class="btn btn-info">
    <i class="las la-chevron-left"></i>
    Volver a las Solicitudes
</a>
<br>
<h3>{{ \App\Models\Product::find(\Route::current()->parameter('product_id'))->title}}</h3>
