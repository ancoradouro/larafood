<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Storage,
};
//use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $repository, $num_pagination = 10;

    public function __construct(Product $product)
    {
        $this->repository = $product;
        $this->middleware(['can:products']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate($this->num_pagination);
        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();

        //dd($request->all());
        if($request->hasFile('image') && $request->image->isValid()){
            $tenant = Auth::user()->tenant_id;
            $data['image'] = $request->image->store("tenants/{$tenant}/products");
        }

        $this->repository->create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        if (!$product = $this->repository->find($id)){
            return redirect()->back();
        }

        $data = $request->all();
        
        if($request->hasFile('image') && $request->image->isValid()){
            $tenant = Auth::user()->tenant_id;
            if($product->image && Storage::exists($product->image)){
                Storage::delete($product->image);
            }
            $data['image'] = $request->image->store("public/tenants/{$tenant}/products");
        }

        $product->update();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        $product->delete();
        return redirect()->route('products.index');
    }

    public function search(Request  $request)
    {
        $filters = $request->only('filter');
        $products = $this->repository
            ->where(function($query) use ($request) {
                if ($request->filter) {
                    $query->orwhere('title', 'LIKE', "%{$request->filter}%");
                    $query->orwhere('description', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate($this->num_pagination);
        return view('admin.pages.products.index', compact('products', 'filters'));
    }
}

