<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Client\ClientRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientsRequest;
use App\Http\Requests\Admin\UpdateClientsRequest;


class ClientsController extends Controller
{
    /**
     * The model client repo
     *
     * @var ClientRepository
     */
    protected $client = null;

    /**
     * The model product repo
     *
     * @var ProductRepository
     */
    protected $product = null;

    /**
     * Create a new controller instance and binds Repo
     *
     * @return void
     */
    public function __construct(ClientRepository $client, ProductRepository $product)
    {
        $this->client =  $client;
        $this->product =  $product;
    }

    /**
     * Display a listing of Client.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('client_delete')) {
                return abort(401);
            }
            $clients = $this->client->deleted();
        } else {
            $clients = $this->client->all();
        }
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating new Client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_create')) {
            return abort(401);
        }
        $customer_products = $this->product->pluck('product_name', 'id');
        return view('admin.clients.create', compact('customer_products'));
    }

    /**
     * Store a newly created Client in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreClientsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientsRequest $request)
    {
        if (! Gate::allows('client_create')) {
            return abort(401);
        }
        $client = $this->client->create($request->all());
        $client->customer_product()->sync(array_filter((array)$request->input('customer_product')));
        return redirect()->route('admin.clients.index');
    }


    /**
     * Show the form for editing Client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_edit')) {
            return abort(401);
        }
        $customer_products = $this->product->pluck('product_name', 'id');
        $client = $this->client->show($id);
        return view('admin.clients.edit', compact('client', 'customer_products'));
    }

    /**
     * Update Client in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateClientsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientsRequest $request, $id)
    {
        if (! Gate::allows('client_edit')) {
            return abort(401);
        }
        $client = $this->client->show($id);
        $client->update($request->all());
        $client->customer_product()->sync(array_filter((array)$request->input('customer_product')));
        return redirect()->route('admin.clients.index');
    }


    /**
     * Display Client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_view')) {
            return abort(401);
        }
        $products = $this->product->has('products_customers', $id);
        $client = $this->client->show($id);
        return view('admin.clients.show', compact('client', 'products'));
    }


    /**
     * Remove Client from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_delete')) {
            return abort(401);
        }
        $this->client->delete($id);
        return redirect()->route('admin.clients.index');
    }

    /**
     * Delete all selected Client at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = $this->client->in('id', $request->input('ids'));

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Client from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('client_delete')) {
            return abort(401);
        }
        $client = $this->client->deleted()->find($id);
        $client->restore();
        return redirect()->route('admin.clients.index');
    }

}
