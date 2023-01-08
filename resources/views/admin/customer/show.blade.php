@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Customer
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.product.fields.name') }}
                    </th>
                    <td>
                        {{ $supplier->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                         sp_id
                    </th>
                    <td>
                        {!! $supplier->sp_id !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection