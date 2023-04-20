<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Constract\Container\BindingResolutionException;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roots = Category::roots();
        return view('admin.category.index', compact('roots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::roots();
        return view('admin.category.create', compact('parents'));
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
            'slug' => 'required|max:100|unique:categories,slug|regex:~^[-_a-z0-9]+$~i',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);

        $file = $request->file('image');
        if ($file) {
            $path = $file->store('catalog/category', 'public');
            $base = basename($path);
        }
        $data = $request->all();
        $data['image'] = $base ?? null;
        $category = Category::create($data);
        return redirect()->route('admin.category.show', ['category' => $category->id])->with('success', 'Новая категория успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parents = Category::roots();
        return view('admin.category.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $id = $category->id;

        if ($request->remove) {
            $old = $category->image;
            if ($old) {
                Storage::disk('public')->delete('catalog/category/'.$old);
            }
        }
        $file = $request->file('image');
        if ($file) {
            $path = $file->store('catalog/category', 'public');
            $base = basename($path);
            $old = $category->image;
            if ($old) {
                Storage::disk('public')->delete('catalog/category/'.$old);
            }
        }
        else{
            $old1 = $category->image;
            $path = url('storage/catalog/category/'.$old1);
            $base = basename($path);
        }

        $data = $request->all();
        $data['image'] = $base ?? null;
        $category->update($data);
        return redirect()->route('admin.category.show', ['category' => $category->id])->with('success', 'Категория была успешно исправлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->products->count()) {
            $errors[] = 'Нельзя удалить категорию, которая содержит товары';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Категория каталога успешно удалена');
    }
}
