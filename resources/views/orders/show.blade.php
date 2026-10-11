@extends('layouts.app')

@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h3>Chi tiết đơn hàng #{{ $order->id }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>Email:</strong> {{ $order->email ?: 'Không có' }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
            <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
            <p><strong>Tổng tiền:</strong> <span class="text-danger">{{ number_format($order->total_amount) }} đ</span></p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Sản phẩm trong đơn hàng</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>

                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ number_format($item->price) }} đ</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->subtotal) }} đ</td>
                    </tr>
                @endforeach
            </table>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
@endsection