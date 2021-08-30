@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('application_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="{{ route('frontend.applications.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.application.title_singular') }}
                            </a>
                        </div>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.application.title_singular') }} {{ trans('global.list') }}
                        
                        <div style="color: blue">
                            No need of applying twice 
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Application">
                                
                                <tbody>
                                    @foreach ($applications as $key => $application)
                                      
                        </div>
                        @endforeach
                        </tbody>
                        </table>

                        
                        <div class="container">
                            <div class="row">
                                {{-- <div class="col">
                                    <ol class="list-decimal text-gray-700 text-base list-inside">
                                        <li>Click the confirm payment button and a pop up page will appear</li>
                                        <li>Confirm the booking details</li>
                                        <li>Enter the safaricom phone number you want to use to make the payment in the
                                            contact's field</li>
                                        <li>Click the pay button</li>
                                        <li>An Mpesa prompt for a payment will appear on your phone</li>
                                        <li>Confirm the total price and the name of company</li>
                                        <li>Put your MPesa PIN in the prompt and click ok</li>
                                        <li>Wait for a notification to appear on the web application page regarding the
                                            payment</li>

                                    </ol>

                                    <ul style="list-style-type:none;">
                                        <li>{{ $application->id ?? '' }}</li>
                                        <li>{{ $application->user->name ?? '' }}</li>
                                        <li>{{ $application->user->email ?? '' }}</li>
                                        <li>{{ $application->property->name ?? '' }}</li>
                                        <li>{{ $application->unit->name ?? '' }}</li>
                                        <li>{{ $application->name ?? '' }}</li>
                                        <li>{{ $application->phone ?? '' }}</li>
                                    </ul>
                                </div> --}}

                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.application.fields.id') }}
                                            </th>
                                            <td>
                                                {{ $application->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.application.fields.user') }}
                                            </th>
                                            <td>
                                                {{ $application->user->name ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.application.fields.property') }}
                                            </th>
                                            <td>
                                                {{ $application->property->name ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.application.fields.unit') }}
                                            </th>
                                            <td>
                                                {{ $application->unit->name ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.application.fields.name') }}
                                            </th>
                                            <td>
                                                {{ $application->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.application.fields.email') }}
                                            </th>
                                            <td>
                                                {{ $application->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.application.fields.phone') }}
                                            </th>
                                            <td>
                                                {{ $application->phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.application.fields.status') }}
                                            </th>
                                            <td>
                                                {{ App\Models\Application::STATUS_SELECT[$application->status] ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>

                                            </th>
                                            <td>
                                            <td>
                                              

                                                @can('application_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('frontend.applications.edit', $application->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                

                                            </td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
    {{-- @section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('application_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.applications.massDestroy') }}",
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
  let table = $('.datatable-Application:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection --}}
