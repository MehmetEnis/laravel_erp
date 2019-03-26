@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('erp.products.title')</h3>
    
    {!! Form::model($product, ['method' => 'PUT', 'route' => ['admin.products.update', $product->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('erp.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product_name', trans('erp.products.fields.product-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('product_name', old('product_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product_name'))
                        <p class="help-block">
                            {{ $errors->first('product_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product_price', trans('erp.products.fields.product-price').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('product_price', old('product_price'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product_price'))
                        <p class="help-block">
                            {{ $errors->first('product_price') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('products_customers', trans('erp.products.fields.products-customers').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-products_customers">
                        {{ trans('erp.select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-products_customers">
                        {{ trans('erp.deselect_all') }}
                    </button>
                    {!! Form::select('products_customers[]', $products_customers, old('products_customers') ? old('products_customers') : $product->products_customers->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-products_customers' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('products_customers'))
                        <p class="help-block">
                            {{ $errors->first('products_customers') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('erp.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-products_customers").click(function(){
            $("#selectall-products_customers > option").prop("selected","selected");
            $("#selectall-products_customers").trigger("change");
        });
        $("#deselectbtn-products_customers").click(function(){
            $("#selectall-products_customers > option").prop("selected","");
            $("#selectall-products_customers").trigger("change");
        });
    </script>
@stop