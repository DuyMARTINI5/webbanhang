<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('orders.show', compact('order'));
    }
}