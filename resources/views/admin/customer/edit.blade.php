@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.product.title_singular') }}
    </div>
    

    <div class="card-body">
        <form action="{{ route("admin.cus.update", [$customer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group {{ $errors->has('customer_num') ? 'has-error' : '' }}">
                <label for="customer_num">Customer Num</label>
                <input type="text" id="customer_num" name="customer_num" class="form-control" value="{{ old('customer_num', isset($customer) ? $customer->customer_num : '') }}">
                @if($errors->has('customer_num'))
                    <em class="invalid-feedback">
                        {{ $errors->first('customer_num') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>

            
               <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : '' }}">
                   <label for="customer_name">Customer Name</label>
                   <input type="text" id="customer_name" name="customer_name" class="form-control" value="{{ old('customer_name', isset($customer) ? $customer->customer_name : '') }}" step="0.01">
                        @if($errors->has('customer_name	'))
                          <em class="invalid-feedback">
                            {{ $errors->first('customer_name') }}
                         </em>
                        @endif
                        <p class="helper-block">
                           {{ trans('global.product.fields.price_helper') }}
                         </p>
                </div>


            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                  <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($customer) ? $customer->address : '') }}" step="0.01">
                    @if($errors->has('address	'))
                        <em class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </em>
                    @endif
                    <p class="helper-block">
                       {{ trans('global.product.fields.price_helper') }}
                     </p>
            </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                       <label for="email">Email</label>
                       <input type="text" id="email" name="email" class="form-control" value="{{ old('email', isset($customer) ? $customer->email : '') }}" step="0.01">
                           @if($errors->has('email	'))
                        <em class="invalid-feedback">
                           {{ $errors->first('email') }}
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