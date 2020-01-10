<div class="{{ $widget['wrapperClass'] ?? 'col-sm-6 col-lg-3' }}">
  <div class="{{ $widget['class'] ?? 'card text-white bg-primary' }}">
    <div class="card-body">

        <div class="row">
            <div class="col-6">
                @if (isset($widget['value']))
                <div class="text-value">{!! $widget['value'] !!}</div>
                @endif

                @if (isset($widget['description']))
                <div>{!! $widget['description'] !!}</div>
                @endif
            </div>
            <div class="col-4">
                    @if (isset($widget['icon']))
                    <div> <i class="{!! $widget['icon'] !!}" style="font-size:80px;"></i></div>
                    @endif
            </div>

        </div>



      @if (isset($widget['progress']))
      <div class="progress progress-white progress-xs my-2">
        <div class="progress-bar" role="progressbar" style="width: {{ $widget['progress']  }}%" aria-valuenow="{{ $widget['progress']  }}" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      @endif

      @if (isset($widget['hint']))
      <small class="text-muted">{!! $widget['hint'] !!}</small>
      @endif
    </div>

    @if (isset($widget['footer_link']))
    <div class="card-footer px-3 py-2">
      <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ $widget['footer_link'] ?? '#' }}"><span class="small font-weight-bold">{{ $widget['footer_text'] ?? 'View more' }}</span><i class="las la-angle-right"></i></a>
    </div>
    @endif
  </div>
</div>
