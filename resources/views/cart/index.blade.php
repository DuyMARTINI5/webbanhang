@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Giỏ hàng</h3>

            @if(count($cart) > 0)
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa toàn bộ giỏ hàng?')">
                        Xóa tất cả
                    </button>
                </form>
            @endif
        </div>

        <div class="card-body">
            @if(count($cart) > 0)
                <table class="table table-bordered align-middle">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th width="160">Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>

                    @php $total = 0; @endphp

                    @foreach($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp

                        <tr>
                            <td width="100">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" width="80" class="img-thumbnail">
                                @else
                                    <span>Không có ảnh</span>
                                @endif
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ number_format($item['price']) }} đ</td>
                            <td>
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <input type="number" name="quantity" class="form-control" min="1" value="{{ $item['quantity'] }}">
                                    <button class="btn btn-primary btn-sm">Cập nhật</button>
                                </form>
                            </td>
                            <td>{{ number_format($subtotal) }} đ</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="4" class="text-end"><strong>Tổng tiền:</strong></td>
                        <td colspan="2"><strong class="text-danger">{{ number_format($total) }} đ</strong></td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Tiếp tục mua hàng</a>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success">Tiến hành đặt hàng</a>
                </div>
            @else
                <div class="alert alert-info mb-0">
                    Giỏ hàng đang trống.
                </div>
            @endif
        </div>
    </div>
@endsection