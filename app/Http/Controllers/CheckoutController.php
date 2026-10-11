<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
    return redirect()->route('login')->withErrors([
        'auth' => 'Bạn cần đăng nhập để đặt hàng',
    ]);
}
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('success', 'Giỏ hàng đang trống');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
    return redirect()->route('login')->withErrors([
        'auth' => 'Bạn cần đăng nhập để đặt hàng',
    ]);
}
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('success', 'Giỏ hàng đang trống');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'total_amount' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                $subtotal = $item['price'] * $item['quantity'];

                $order->items()->create([
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ]);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('home')
                ->with('success', 'Đặt hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Đặt hàng thất bại: ' . $e->getMessage()]);
        }
    }
}