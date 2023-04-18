<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index(){
        $roots = Product::where('parent_id', 0)->get();
        
        return view('catalog.index', compact('roots'))
    }

    public function category($slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category_id)->get();
        
        return view('catalog.category', compact('category', 'products'));
    }

    public function product($slug){
        $product = Product::select(
            'products.*',
            'categories.name as category_name',
            'categories.slug as category_slug',
        )
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.slug', $slug)
            ->firstOrFail();
        
        return view('catalog.product', compact('product'));
    }
}
