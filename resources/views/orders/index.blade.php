@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3>Danh sách đơn hàng</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>

                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ number_format($order->total_amount) }} đ</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection