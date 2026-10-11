<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Danh sách đơn hàng',
            'data' => $orders
        ], 200);
    }

    public function show(Order $order)
    {
        return response()->json([
            'status' => true,
            'message' => 'Chi tiết đơn hàng',
            'data' => $order
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'total_price' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:50',
        ]);

        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'status' => $request->status ?? 'pending',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Tạo đơn hàng thành công',
            'data' => $order
        ], 201);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
        ]);

        $order->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật đơn hàng thành công',
            'data' => $order
        ], 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa đơn hàng thành công'
        ], 200);
    }
}