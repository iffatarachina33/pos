@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.pur.add") }}">
                {{ trans('global.add') }} Purchase
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Create Purchase
    </div>
    
    @if(session()->has('msg'))
        <div class="alert alert-success">
            {{ session()->get('msg') }}
        </div>
    @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                
                        <th>
                            Ref_no
                        </th>
                        <th>
                             Date
                        </th>
                        <th>
                             Total_product
                        </th>
                        <th>
                            Discount
                        </th> 
                        <th>
                            Vat
                        </th>           
                        <th>
                            &nbsp; Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $key => $item)
                        <tr data-entry-id="{{ $item->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $item->ref_no ?? '' }}
                            </td>
                            <td>
                                {{ $item->date ?? '' }}
                            </td>
                            <td>
                                {{ $item->total_product ?? '' }}
                            </td>
                            <td>
                                {{ $item->discount ?? '' }}
                            </td>
                            <td>
                                {{ $item->vat ?? '' }}
                            </td>
                            <td>
                                @can('product_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pur.edit', $item->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('product_delete')
                                    <form action="{{ route('admin.pur.dlt', $item->id) }}" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection