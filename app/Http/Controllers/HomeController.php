<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display the home page with a listed set of categories.
     *
     * @return View The home view featuring cached categories.
     */
    public function index(): View
    {
        // Cache categories for better performance and consistent UI ordering
        $categories = Cache::remember('home_categories', 86400, function () {
            return Category::orderBy('name', 'asc')->get();
        });
        
        return view('home', compact('categories'));
    }

    /**
     * Display the contact page.
     *
     * @return View The contact view.
     */
    public function contact(): View
    {
        return view('contact');
    }

    /**
     * Display the about page.
     *
     * @return View The about view.
     */
    public function about(): View
    {
        return view('about');
    }

    /**
     * Display the gallery page.
     *
     * @return View The gallery view.
     */
    public function gallery(): View
    {
        return view('gallery');
    }

    /**
     * Display the policies page.
     *
     * @return View The policies view.
     */
    public function policies(): View
    {
        return view('policies');
    }
}
