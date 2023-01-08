@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Sell
    </div>

    <div class="card-body">
        {{-- dd($sell[0]->id) --}}
        <form action="{{ route("admin.sell.update", [$sell[0]->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('ref_no') ? 'has-error' : '' }}">
                        <label for="ref_no">Reference No</label>
                        <input type="number" id="ref_no" name="ref_no" value="{{$sell[0]->ref_no ?? ''}}" class="form-control">
                        @if($errors->has('ref_no'))
                            <em class="invalid-feedback">
                                {{ $errors->first('ref_no') }} 
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.product.fields.price_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Customer</label>
                          <select class="form-control" name="customer_name" id="customer_name">
                             <option hidden>Choose Customer</option>
                                @foreach ($customers as $item)
                             <option value="{{ $item->id }}" {{ $item->id == $sell[0]->customer_id ? 'selected':''}}>{{ $item->customer_name }}</option>
                                @endforeach
                          </select>
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Date </label>
                        <input type="date" id="date" name="date" class="form-control"
                        value = "{{ $sell[0]->date }}">
                        @if($errors->has('date'))
                            <em class="invalid-feedback">
                                {{ $errors->first('date') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.product.fields.price_helper') }}
                        </p> 
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Product </label>
                        <select class="form-control search_product" name="product_id" id="products">
                            <option hidden>Choose product</option>
                                @foreach ($products as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                        <label for="discount">QTY</label>
                        <input type="number" id="qty" name="qty" class="form-control" value="{{ old('qty', isset($purchase) ? $purchase->qty : '') }}" step="0.01">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="">Product List </label>
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th width="10">
                                                SN
                                            </th>
                                            <th>
                                                code
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Unit Price
                                            </th>
                                            <th>
                                                Qty/Amount
                                            </th>
                                            <th>
                                                Total
                                            </th>
                                            <th>
                                                &nbsp;Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                 @foreach($tmp_sell as $key => $item)
                                            <tr data-entry-id="0">
                                                <td>
                                                   {{ $key+1}}
                                                </td>
                                                <td>
                                                {{$item->product_id}}
                                                </td>
                                                <td>
                                                {{$item->name}}
                                                </td>
                                                <td>
                                                {{$item->rate}}
                                                </td>
                                                <td>
                                                {{$item->qty}}
                                                </td>
                                                <td>
                                                {{$item->rate*$item->qty}}
                                                </td>
                                                <td>
                                                {{$item->action}}
                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sell.edit', $item->id) }}">
                                                        Edit 
                                                    </a>
                                                

                                                    <a class="btn btn-xs btn-danger" href="{{ route('admin.sell.delete', $item->id) }}">
                                                        Delete
                                                    </a>

                                                                                            
                                                </td>
                                            </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                            <label for="discount">Discount</label>
                            <input type="number" id="discount" name="discount" value="{{$sell[0]->discount ?? ''}}" class="form-control">
                            @if($errors->has('item_list'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('item_list') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.price_helper') }}
                            </p>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-4">
                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                        <label for="vat">Vat</label>
                        <input type="number" id="vat" name="vat"  value="{{$sell[0]->vat ?? ''}}" class="form-control">
                        @if($errors->has('vat'))
                            <em class="invalid-feedback">
                                {{ $errors->first('vat') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.product.fields.price_helper') }}
                        </p>
                    </div>
                    </div>
            </div>
            <div>
                <input class="btn btn-success" type="submit" name="add_item" value="Add Data">
            </div>

            </div>
            <div class="col-md-12 text-right">
                
                <div>
                    <input class="btn btn-danger" type="submit" name="submit" value="Update">
                </div>
            </div>
        </form>
    </div>
</div>

    @endsection

        @section('scripts')
                <script>
                $(document).ready(function() {
                    $('#products').select2();
                    $("#products").change(function(){
                        //console.log('clicked');
                        var product_id = $('#products').find(":selected").val();
                        //var item1 = $('#products').find(":selected");
                        //console.log($('#products :selected').text());

                        var url = "{{route('admin.pur.getProductById', ':id')}}";
                        url = url.replace(':id', product_id);

                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function(data) {
                                //$('#city').html(data.html);
                                console.log(data);
                            },
                            error: function() { 
                                console.log(data);
                            }
                        });
                    });
                });
                </script>
         @endsection