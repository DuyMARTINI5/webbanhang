<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   public function index(Request $request)
{
    $query = Product::with('category');

    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    $products = $query->latest()->paginate(8)->withQueryString();
    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|min:3|max:100',
        'description' => 'nullable',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
    ]);

    $data = $request->only(['name', 'description', 'price', 'category_id']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($data);

    return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
}

    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|min:3|max:100',
        'description' => 'nullable',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
    ]);

    $data = $request->only(['name', 'description', 'price', 'category_id']);

    if ($request->hasFile('image')) {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công');
}

    public function destroy(Product $product)
{
    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
}

    public function home(Request $request)
{
    $query = Product::with('category');

    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    $products = $query->latest()->paginate(8)->withQueryString();
    $categories = Category::all();

    return view('home', compact('products', 'categories'));
}
}