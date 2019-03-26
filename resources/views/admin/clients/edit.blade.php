@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('erp.clients.title')</h3>
    
    {!! Form::model($client, ['method' => 'PUT', 'route' => ['admin.clients.update', $client->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('erp.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('first_name', trans('erp.clients.fields.first-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('first_name'))
                        <p class="help-block">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('last_name', trans('erp.clients.fields.last-name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('last_name'))
                        <p class="help-block">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('customer_product', trans('erp.clients.fields.customer-product').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-customer_product">
                        {{ trans('erp.select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-customer_product">
                        {{ trans('erp.deselect_all') }}
                    </button>
                    {!! Form::select('customer_product[]', $customer_products, old('customer_product') ? old('customer_product') : $client->customer_product->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-customer_product' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('customer_product'))
                        <p class="help-block">
                            {{ $errors->first('customer_product') }}
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
        $("#selectbtn-customer_product").click(function(){
            $("#selectall-customer_product > option").prop("selected","selected");
            $("#selectall-customer_product").trigger("change");
        });
        $("#deselectbtn-customer_product").click(function(){
            $("#selectall-customer_product > option").prop("selected","");
            $("#selectall-customer_product").trigger("change");
        });
    </script>
@stop