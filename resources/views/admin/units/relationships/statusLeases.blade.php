@can('lease_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.leases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.lease.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.lease.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-statusLeases">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.lease.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.lease.fields.application') }}
                        </th>
                        <th>
                            {{ trans('cruds.lease.fields.amount_invoiced') }}
                        </th>
                        <th>
                            {{ trans('cruds.lease.fields.property') }}
                        </th>
                        <th>
                            {{ trans('cruds.lease.fields.unit') }}
                        </th>
                        <th>
                            {{ trans('cruds.lease.fields.paid') }}
                        </th>
                        <th>
                            {{ trans('cruds.lease.fields.paid_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.lease.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leases as $key => $lease)
                        <tr data-entry-id="{{ $lease->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $lease->id ?? '' }}
                            </td>
                            <td>
                                @foreach($lease->applications as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $lease->amount_invoiced->amount ?? '' }}
                            </td>
                            <td>
                                {{ $lease->property->name ?? '' }}
                            </td>
                            <td>
                                {{ $lease->unit->name ?? '' }}
                            </td>
                            <td>
                                {{ $lease->paid ?? '' }}
                            </td>
                            <td>
                                {{ $lease->paid_at ?? '' }}
                            </td>
                            <td>
                                {{ $lease->status->status ?? '' }}
                            </td>
                            <td>
                                @can('lease_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.leases.show', $lease->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('lease_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.leases.edit', $lease->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('lease_delete')
                                    <form action="{{ route('admin.leases.destroy', $lease->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('lease_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.leases.massDestroy') }}",
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
  let table = $('.datatable-statusLeases:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection