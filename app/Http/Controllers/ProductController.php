<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Product::query();

        // Jika ada parameter search
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Get products with pagination dan pertahankan parameter search
        $products = $query->latest()->paginate(6)->appends($request->only('search'));

        // Render view with products
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $request->validate([
            'image'         => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0'
        ]);

        // Upload image
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
        }

        // Create product
        Product::create([
            'image'         => $image,
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        // Redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // Get product by ID
        $product = Product::findOrFail($id);

        // Render view with product
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // Get product by ID
        $product = Product::findOrFail($id);

        // Render view with product
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validate form
        $request->validate([
            'image'         => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0'
        ]);

        // Get product by ID
        $product = Product::findOrFail($id);

        // Check if image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // Upload new image
            $image = $request->file('image')->store('products', 'public');
        } else {
            $image = $product->image;
        }

        // Update product
        $product->update([
            'image'         => $image,
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        // Redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        // Get product by ID
        $product = Product::findOrFail($id);

        // Delete image
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // Delete product
        $product->delete();

        // Redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    /**
     * AJAX search for products
     */
    public function ajaxSearch(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::query();
            
            if (!empty($request->search)) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('title', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
                });
            }

            $products = $query->latest()->take(5)->get();
            
            return response()->json([
                'success' => true,
                'products' => $products->map(function($product) {
                    return [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => number_format($product->price, 0, ',', '.'),
                        'image' => $product->image ? asset('storage/' . $product->image) : null,
                        'url' => route('products.show', $product->id)
                    ];
                })
            ]);
        }
        
        return response()->json(['success' => false]);
    }
}