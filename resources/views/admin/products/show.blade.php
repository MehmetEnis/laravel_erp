@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('erp.products.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('erp.view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('erp.products.fields.product-name')</th>
                            <td field-key='product_name'>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('erp.products.fields.product-price')</th>
                            <td field-key='product_price'>{{ $product->product_price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('erp.products.fields.products-customers')</th>
                            <td field-key='products_customers'>
                                @foreach ($product->products_customers as $singleProductsCustomers)
                                    <span class="label label-info label-many">{{ $singleProductsCustomers->first_name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#clients" aria-controls="clients" role="tab" data-toggle="tab">Clients</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="clients">
<table class="table table-bordered table-striped {{ count($clients) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('erp.clients.fields.first-name')</th>
                        <th>@lang('erp.clients.fields.last-name')</th>
                        <th>@lang('erp.clients.fields.customer-product')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($clients) > 0)
            @foreach ($clients as $client)
                <tr data-entry-id="{{ $client->id }}">
                    <td field-key='first_name'>{{ $client->first_name }}</td>
                                <td field-key='last_name'>{{ $client->last_name }}</td>
                                <td field-key='customer_product'>
                                    @foreach ($client->customer_product as $singleCustomerProduct)
                                        <span class="label label-info label-many">{{ $singleCustomerProduct->product_name }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('client_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("erp.are_you_sure")."');",
                                        'route' => ['admin.clients.restore', $client->id])) !!}
                                    {!! Form::submit(trans('erp.restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('client_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("erp.are_you_sure")."');",
                                        'route' => ['admin.clients.perma_del', $client->id])) !!}
                                    {!! Form::submit(trans('erp.permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('client_view')
                                    <a href="{{ route('admin.clients.show',[$client->id]) }}" class="btn btn-xs btn-primary">@lang('erp.view')</a>
                                    @endcan
                                    @can('client_edit')
                                    <a href="{{ route('admin.clients.edit',[$client->id]) }}" class="btn btn-xs btn-info">@lang('erp.edit')</a>
                                    @endcan
                                    @can('client_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("erp.are_you_sure")."');",
                                        'route' => ['admin.clients.destroy', $client->id])) !!}
                                    {!! Form::submit(trans('erp.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('erp.no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.products.index') }}" class="btn btn-default">@lang('erp.back_to_list')</a>
        </div>
    </div>
@stop


