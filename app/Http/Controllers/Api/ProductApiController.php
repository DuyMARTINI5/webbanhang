<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Danh sách sản phẩm',
            'data' => ProductResource::collection($products),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validated);
        $product->load('category');

        return response()->json([
            'status' => true,
            'message' => 'Thêm sản phẩm thành công',
            'data' => new ProductResource($product),
        ], 201);
    }

    public function show(string $id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy sản phẩm',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Chi tiết sản phẩm',
            'data' => new ProductResource($product),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy sản phẩm',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);
        $product->load('category');

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật sản phẩm thành công',
            'data' => new ProductResource($product),
        ]);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy sản phẩm',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa sản phẩm thành công',
        ]);
    }
}