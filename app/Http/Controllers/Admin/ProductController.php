<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::simplePaginate(5);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Category::all();     
        return view('admin.product.create', compact('items'));                                          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'integer',
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:products,slug|regex:~^[-_a-z0-9]+$~i',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);

        $file = $request->file('image');
        if ($file) {
            $path = $file->store('catalog/product', 'public');
            $base = basename($path);
        }
        $data = $request->all();
        $data['image'] = $base ?? null;
        $product = Product::create($data);
        return redirect()->route('admin.product.show', ['product' => $product->id])->with('success', 'Новый товар успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $items = Category::all();     
        return view('admin.product.edit', compact('product', 'items'));     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->remove) {
            $old = $product->image;
            if ($old) {
                Storage::disk('public')->delete('catalog/product/'.$old);
            }
        }
        $file = $request->file('image');
        if ($file) {
            $path = $file->store('catalog/product', 'public');
            $base = basename('$path');
            $old = $product->image;
            if ($old) {
                Storage::disk('public')->delete('catalog/product/'.$old);
            }
        }
        else{
            $old1 = $product->image;
            $path = url('storage/catalog/product/'.$old1);
            $base = basename($path);
        }
        $data = $request->all();
        $product->update($data);
        return redirect()->route('admin.product.show', ['product' => $product->id])->with('success', 'Товар был успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $old = $product->image;
        if ($old) {
            Storage::disk('public')->delete('catalog/product/'.$old);
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Товар каталога успешно удален');
    }
}
