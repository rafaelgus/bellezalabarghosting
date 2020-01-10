<a href="{{ route('poll.index')}}" class="btn btn-info">
    <i class="fa fa-chevron-left"></i>
    Volver a las Encuestas
</a>
<br>
<h3>{{ \App\Models\Poll::find(\Route::current()->parameter('poll_id'))->title }}</h3>
