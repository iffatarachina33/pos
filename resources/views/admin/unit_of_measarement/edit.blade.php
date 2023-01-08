@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.product.title_singular') }}
    </div>
    

    <div class="card-body">
        <form action="{{ route("admin.uom.update", [$unit_of_measarement->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            
            <div class="form-group {{ $errors->has('uom_name') ? 'has-error' : '' }}">
                <label for="uom_name">Uom_name</label>
                <input type="text" id="uom_name" name="uom_name" class="form-control" value="{{ old('uom_name', isset($unit_of_measarement) ? $unit_of_measarement->uom_name : '') }}" step="0.01">
                @if($errors->has('uom_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('uom_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.price_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection