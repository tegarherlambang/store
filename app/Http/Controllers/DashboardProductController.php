<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Http\Requests\Admin\ProductRequest;
use App\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries','category'])
            ->where('users_id', Auth::user()->id)
            ->get();
        return view('pages.dashboard-products',[
            'products' => $products
        ]);
    }

    public function details(Request $request, $id)
    {
        $product = Product::with((['galleries', 'user', 'category']))->findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-products-details',[
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public');   

        ProductGallery::create($data);
        return redirect()->route('dashboard-product-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

         return redirect()->route('dashboard-product-details', $item->products_id);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create', [
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $galllery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product','public')
        ];

        ProductGallery::create($galllery);

        return redirect()->route('dashboard-product');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Product::FindorFail($id);
        
        $data['slug'] = Str::slug($request->name);

        $item->update($data);
        return redirect()->route('dashboard-product');
    }
}
