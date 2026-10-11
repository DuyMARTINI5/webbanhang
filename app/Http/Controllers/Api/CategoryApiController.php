<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => true,
            'message' => 'Danh sách danh mục',
            'data' => $categories
        ], 200);
    }

    public function show(Category $category)
    {
        return response()->json([
            'status' => true,
            'message' => 'Chi tiết danh mục',
            'data' => $category
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thêm danh mục thành công',
            'data' => $category
        ], 201);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật danh mục thành công',
            'data' => $category
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa danh mục thành công'
        ], 200);
    }
}