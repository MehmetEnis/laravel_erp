<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Product\ProductRepository;
use App\Repositories\Client\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;

class ProductsController extends Controller
{
    /**
     * The model product repo
     *
     * @var ProductRepository
     */
    protected $product = null;

    /**
     * The model client repo
     *
     * @var ProductRepository
     */
    protected $client = null;


    /**
     * Create a new controller instance and binds Repo
     *
     * @return void
     */
    public function __construct(ProductRepository $product, ClientRepository $client)
    {
        $this->product = $product;
        $this->client = $client;
    }


    /**
     * Display a listing of Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('product_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('product_delete')) {
                return abort(401);
            }
            $products = $this->product->deleted();
        } else {
            $products = $this->product->all();
        }

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating new Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
        $products_customers = $this->client->all()->pluck('first_name', 'id');
        return view('admin.products.create', compact('products_customers'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
        $product = $this->product->create($request->all());
        $product->products_customers()->sync(array_filter((array)$request->input('products_customers')));
        return redirect()->route('admin.products.index');
    }


    /**
     * Show the form for editing Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('product_edit')) {
            return abort(401);
        }
        $products_customers = $this->client->all()->pluck('first_name', 'id');
        $product = $this->product->show($id);
        return view('admin.products.edit', compact('product', 'products_customers'));
    }

    /**
     * Update Product in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateProductsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, $id)
    {
        if (! Gate::allows('product_edit')) {
            return abort(401);
        }
        $product = $this->product->show($id);
        $product->update($request->all());
        $product->products_customers()->sync(array_filter((array)$request->input('products_customers')));
        return redirect()->route('admin.products.index');
    }


    /**
     * Display Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('product_view')) {
            return abort(401);
        }
        $clients = $this->client->has('customer_product', $id);
        $product = $this->product->show($id);
        return view('admin.products.show', compact('product', 'clients'));
    }


    /**
     * Remove Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        $this->product->delete($id);
        return redirect()->route('admin.products.index');
    }

    /**
     * Delete all selected Product at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('product_delete')) {
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
     * Restore Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        $product = $this->product->deleted()->find($id);
        $product->restore();
        return redirect()->route('admin.products.index');
    }

}
