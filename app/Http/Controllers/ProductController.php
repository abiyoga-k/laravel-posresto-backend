<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.pages.products.index', [
            'products' => Product::all(),
            'title' => 'Product',
            'route' => '/dashboard/products'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.products.create', [
            'categories' => Category::all(),
            'title' => 'Product',
            'route' => '/dashboard/products'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|file|max:1624',
            'category_id' => 'required',
            'price' => 'required',
            'status' => 'required',
            'stock' => 'required',
            'is_favorite' => 'required'
        ]);



        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('products-image', 'public');
        }

        $validatedData['description'] = $request->description;
        $validatedData['slug'] = Str::slug($request->name, '-');

        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'New Post Has Been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $product = Product::where('slug', '=', $slug)->first();
        return view('dashboard.pages.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'title' => 'Product',
            'route' => '/dashboard/products'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $slug)
    {
        $product = Product::where('slug', '=', $slug)->first();

        $rules = [
            // 'name' => 'required|max:255',
            'image' => 'image|file|max:1624',
            'category_id' => 'required',
            'price' => 'required',
            'status' => 'required',
            'stock' => 'required',
            'is_favorite' => 'required'
        ];

        if ($request->name != $product->name) {
            $rules['name'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);
        $imagePath = $product->image;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($imagePath);
            }
            $validatedData['image'] = $request->file('image')->store('products-image', 'public');
        }


        Product::where('id', $product->id)->update($validatedData);

        return redirect('/dashboard/products')->with('success', 'Product Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $imagePath = $product->image;
        if ($product->image) {
            Storage::disk('public')->delete($imagePath);
        }
        Product::destroy($product->id);

        return redirect('/dashboard/products')->with('success', 'New Post Has Been Deleted!');
    }
}
