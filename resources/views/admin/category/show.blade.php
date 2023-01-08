@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Category
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.product.fields.name') }}
                    </th>
                    <td>
                        {{ $category->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Code
                    </th>
                    <td>
                        {!! $category->code !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection