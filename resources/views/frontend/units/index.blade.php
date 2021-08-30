@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('unit_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.units.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.unit.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.unit.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Unit">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.unit.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unit.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unit.fields.property') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unit.fields.rent') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unit.fields.property_unit') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unit.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($units as $key => $unit)
                                    <tr data-entry-id="{{ $unit->id }}">
                                        <td>
                                            {{ $unit->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unit->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unit->property->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unit->property->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unit->rent ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($unit->property_units as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ App\Models\Unit::STATUS_SELECT[$unit->status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('unit_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.units.show', $unit->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('unit_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.units.edit', $unit->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('unit_delete')
                                                <form action="{{ route('frontend.units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('unit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.units.massDestroy') }}",
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
  let table = $('.datatable-Unit:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection