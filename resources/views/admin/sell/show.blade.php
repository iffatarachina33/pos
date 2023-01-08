@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Sell
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.product.fields.customer_id') }}
                    </th>
                    <td>
                        {{ $sell->customer_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                         date
                    </th>
                    <td>
                        {!! $sell->date !!}
                    </td>
                </tr>
                <tr>
                    <th>
                         discount
                    </th>
                    <td>
                        {!! $sell->discount !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection