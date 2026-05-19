<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products for a specific category.
     *
     * @param Category $category The category to display products for.
     * @return View The catalog view containing the paginated products.
     */
    public function index(Category $category): View
    {
        $products = $category->products()->paginate(12);
        
        return view('catalog', compact('category', 'products'));
    }
}
