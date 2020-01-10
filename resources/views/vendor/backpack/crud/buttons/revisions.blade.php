@if ($crud->hasAccess('revisions') && count($entry->revisionHistory))
    <a href="{{ url($crud->route.'/'.$entry->getKey().'/revisions') }}" class="btn btn-sm btn-link"><i class="las la-history"></i> {{ trans('backpack::crud.revisions') }}</a>
@endif
