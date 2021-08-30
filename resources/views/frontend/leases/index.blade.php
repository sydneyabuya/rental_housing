@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('lease_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.leases.create') }}">
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
                    @if (Auth::user()->roles('Admin'))
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Lease">
                            {{-- <thead>
                                <tr>
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
                            </thead> --}}
                            <tbody>
                                @foreach($leases as $key => $lease)
                                    <tr data-entry-id="{{ $lease->id }}">
                                        {{-- <td>
                                            {{ $lease->id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($lease->applications as $key => $item)
                                                <span>{{ $item->name }}</span>
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
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.leases.show', $lease->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('lease_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.leases.edit', $lease->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('lease_delete')
                                                <form action="{{ route('frontend.leases.destroy', $lease->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td> --}}

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $lease->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.application') }}
                                    </th>
                                    <td>
                                        @foreach($lease->applications as $key => $application)
                                            <span class="label label-info">{{ $application->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.amount_invoiced') }}
                                    </th>
                                    <td>
                                        {{ $lease->amount_invoiced->amount ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.property') }}
                                    </th>
                                    <td>
                                        {{ $lease->property->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.unit') }}
                                    </th>
                                    <td>
                                        {{ $lease->unit->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.paid') }}
                                    </th>
                                    <td>
                                        {{ $lease->paid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.paid_at') }}
                                    </th>
                                    <td>
                                        {{ $lease->paid_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $lease->status->status ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>

                                    </th>
                                    <td>
                                        @can('lease_show')
                                            <a class="btn btn-xs btn-primary" href="{{ route('frontend.leases.show', $lease->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan

                                        @can('lease_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('frontend.leases.edit', $lease->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                        @can('lease_delete')
                                            <form action="{{ route('frontend.leases.destroy', $lease->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    @endif
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
@can('lease_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.leases.massDestroy') }}",
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
  let table = $('.datatable-Lease:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection