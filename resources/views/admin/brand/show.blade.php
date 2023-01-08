@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Brand
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.product.fields.brand_id') }}
                    </th>
                    <td>
                        {{ $brand->brand_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                    brand_name
                    </th>
                    <td>
                        {!! $brand->brand_name !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection