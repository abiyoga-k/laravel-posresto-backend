<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HasFormatRupiah;

class DashboardController extends Controller
{
    use HasFormatRupiah;
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'categories' => Category::all(),
            'products' => Product::all(),
            'product_count' => Product::all()->count(),
            'category_count' => Category::all()->count(),
        ]);
    }
}
