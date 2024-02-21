<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pages.categories.index', [
            'categories' => Category::all(),
            'title' => 'Category',
            'route' => '/dashboard/categories'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.categories.create', [
            'title' => 'Category',
            'page' => 'Create',
            'route' => '/dashboard/categories'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'image' => 'image|file|max:1624',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('categories-image', 'public');
        }

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'New Post Has Been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.pages.categories.edit', [
            'category' => $category,
            'title' => 'Category',
            'route' => '/dashboard/categories'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            // 'name' => 'required|max:255|unique:categories',
            'image' => 'image|file|max:1624',
        ]);

        $validatedData['description'] = $request->description;

        if ($request->name != $category->name) {
            $rules['name'] = 'required|max:255|unique:categories';
        }

        // $product = Category::where('slug', '=', $slug)->first();
        // dd($request->oldImage);
        $imagePath = $category->image;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($imagePath);
            }
            $validatedData['image'] = $request->file('image')->store('categories-image', 'public');
        }

        Category::where('id', $category->id)->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'New Post Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $imagePath = $category->image;
        if ($category->image) {
            Storage::disk('public')->delete($imagePath);
        }
        Category::destroy($category->id);

        return redirect('/dashboard/categories')->with('success', 'New Post Has Been Deleted!');
    }
}
