@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('maintenance_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.maintenances.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.maintenance.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.maintenance.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Maintenance">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.property') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.unit') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.specify') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($maintenances as $key => $maintenance)
                                    <tr data-entry-id="{{ $maintenance->id }}">
                                        <td>
                                            {{ $maintenance->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenance->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenance->property->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenance->unit->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenance->specify ?? '' }}
                                        </td>
                                        <td>
                                            @can('maintenance_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.maintenances.show', $maintenance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('maintenance_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.maintenances.edit', $maintenance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('maintenance_delete')
                                                <form action="{{ route('frontend.maintenances.destroy', $maintenance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('maintenance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.maintenances.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Maintenance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection