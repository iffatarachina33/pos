@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.product.title_singular') }}
    </div>
    

    <div class="card-body">
        <form action="{{ route("admin.sup.update", [$supplier->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($supplier) ? $supplier->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>

            
            <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : '' }}">
                <label for="supplier_id">Supplier_id</label>
                <input type="number" id="supplier_id" name="supplier_id" class="form-control" value="{{ old('supplier_id', isset($supplier) ? $supplier->supplier_id : '') }}" step="0.01">
                @if($errors->has('supplier_id	'))
                    <em class="invalid-feedback">
                        {{ $errors->first('supplier_id') }}
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