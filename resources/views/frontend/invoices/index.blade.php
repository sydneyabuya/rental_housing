@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('invoice_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.invoices.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.invoice.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.invoice.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Invoice">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.tenant') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.billing_for') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.due') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $key => $invoice)
                                    <tr data-entry-id="{{ $invoice->id }}">
                                        {{-- <td>
                                            {{ $invoice->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->tenant->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->billing_for ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->due ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Invoice::STATUS_SELECT[$invoice->status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('invoice_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.invoices.show', $invoice->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('invoice_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.invoices.edit', $invoice->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('invoice_delete')
                                                <form action="{{ route('frontend.invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                        {{ $invoice->tenant->name ?? '' }}
                        {{ $invoice->billing_for ?? '' }}
                        {{ $invoice->amount ?? '' }}
                        {{ $invoice->due ?? '' }}

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $invoice->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.tenant') }}
                                    </th>
                                    <td>
                                        {{ $invoice->tenant->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.billing_for') }}
                                    </th>
                                    <td>
                                        {{ $invoice->billing_for }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $invoice->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.due') }}
                                    </th>
                                    <td>
                                        {{ $invoice->due }}
                                    </td>
                                </tr>
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
@can('invoice_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.invoices.massDestroy') }}",
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
  let table = $('.datatable-Invoice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection