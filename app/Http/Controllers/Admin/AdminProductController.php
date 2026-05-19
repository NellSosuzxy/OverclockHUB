<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.add-product', compact('categories'));
    }

    public function storeProduct(\App\Http\Requests\StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();

            $category = Category::find($validated['category_id']);
            if (!$category) {
                throw new \UnexpectedValueException('Selected hardware category no longer exists.');
            }

            // Prevent infinite loop if random generator collides excessively
            $attempts = 0;
            do {
                $sku = 'SKU-' . strtoupper(Str::random(8));
                $attempts++;
                if ($attempts > 50) {
                    throw new \Exception('Failed to generate a unique SKU after multiple attempts.');
                }
            } while (Product::where('sku', $sku)->exists());

            Product::create([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'price' => $validated['price'],
                'image_label' => $validated['image_label'] ?? strtoupper(Str::limit($category->slug, 4, '')),
                'sku' => $sku,
                'stock' => $validated['stock'],
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Hardware committed to registry.');
            
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        } catch (\UnexpectedValueException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'A system error occurred while registering hardware.')->withInput();
        }
    }

    public function editProduct(Product $product)
    {
        $categories = Category::all();
        return view('admin.edit-product', compact('product', 'categories'));
    }

    public function updateProduct(\App\Http\Requests\StoreProductRequest $request, Product $product)
    {
        try {
            $validated = $request->validated();
            
            $product->update([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'price' => $validated['price'],
                'image_label' => $validated['image_label'] ?? $product->image_label,
                'stock' => $validated['stock'],
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Hardware parameters updated.');
        } catch (\Exception $e) {
            return back()->with('error', 'A system error occurred while updating hardware.')->withInput();
        }
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Hardware permanently removed from rotation.');
    }
}
