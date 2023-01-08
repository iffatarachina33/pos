@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Purchase
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.product.fields.supplier_id') }}
                    </th>
                    <td>
                        {{ $purchase->supplier_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                         date
                    </th>
                    <td>
                        {!! $purchase->date !!}
                    </td>
                </tr>
                <tr>
                    <th>
                         discount
                    </th>
                    <td>
                        {!! $purchase->discount !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection