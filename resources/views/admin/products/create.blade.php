@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.product.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.products.store") }}" method="POST" enctype="multipart/form-data">
            @csrf


        <div class="form-group">
          <label for="">Supplier name </label>
          <select class="form-control" name="supplier_id" id="supplier_id">
               <option hidden>Choose supplier</option>
                @foreach ($supplier as $item)
               <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
          </select>
        </div>


        <div class="form-group">
          <label for="">Category </label>
          <select class="form-control" name="category_id" id="category_id">
               <option hidden>Choose category</option>
                @foreach ($category as $item)
               <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
          </select>
        </div>


        <div class="form-group">
          <label for="brand_name">Brand </label>
          <select class="form-control" name="brand_id" id="brand_id">
               <option hidden>Choose brand</option>
                @foreach ($brand as $item)
               <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                @endforeach
          </select>
        </div>



        <div class="form-group">
          <label for="">Uom</label>
          <select class="form-control" name="uom_name" id="uom_name">
               <option hidden>Choose unitOfMeasarement</option>
                @foreach ($unitOfMeasarement as $item)
               <option value="{{ $item->id }}">{{ $item->uom_name }}</option>
                @endforeach
          </select>
        </div>


        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                <label for="code">Code</label>
                <input type="number" id="code" name="code" class="form-control" value="{{ old('code', isset($product) ? $product->code : '') }}" step="0.01">
                @if($errors->has('code'))
                    <em class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.price_helper') }}
                </p>
        </div>

        
        
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}">
                    @if($errors->has('name'))
                       <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                       </em>
                    @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>
             <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                 <label for="description">{{ trans('global.product.fields.description') }}</label>
                 <textarea id="description" name="description" class="form-control ">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                   @if($errors->has('description'))
                      <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                      </em>
                   @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.description_helper') }}
                </p>
             </div>

            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('global.product.fields.price') }}</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}" step="0.01">
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('price') }}
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