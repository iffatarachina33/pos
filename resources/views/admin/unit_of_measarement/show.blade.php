@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Unit_of_measarement
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.product.fields.uom_name') }}
                    </th>
                    <td>
                        {{ $unit_of_measarement->uom_name }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection