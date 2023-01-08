@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.product.title_singular') }}
    </div>
    

    <div class="card-body">
        <form action="{{ route("admin.brn.update", [$brand->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : '' }}">
                <label for="brand_id">{{ trans('global.product.fields.name') }}*</label>
                <input type="number" id="brand_id" name="brand_id" class="form-control" value="{{ old('brand_id', isset($brand) ? $brand->brand_id : '') }}">
                @if($errors->has('brand_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('brand_id') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>

            
            <div class="form-group {{ $errors->has('brand_name') ? 'has-error' : '' }}">
                <label for="brand_name">Brand_name</label>
                <input type="text" id="brand_name" name="brand_name" class="form-control" value="{{ old('brand_name', isset($brand) ? $brand->brand_name : '') }}" step="0.01">
                @if($errors->has('brand_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('brand_name') }}
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