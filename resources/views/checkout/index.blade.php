@extends('layouts.app')

@section('content')
    @php $total = 0; @endphp

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3>Thông tin đặt hàng</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ nhận hàng</label>
                            <textarea name="address" class="form-control" rows="4">{{ old('address') }}</textarea>
                        </div>

                        <button class="btn btn-success">Xác nhận đặt hàng</button>
                        <a href="{{ route('cart.index') }}" class="btn btn-secondary">Quay lại giỏ hàng</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3>Đơn hàng của bạn</h3>
                </div>
                <div class="card-body">
                    @foreach($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp

                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div>
                                <strong>{{ $item['name'] }}</strong><br>
                                <small>Số lượng: {{ $item['quantity'] }}</small>
                            </div>
                            <div>{{ number_format($subtotal) }} đ</div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between pt-3">
                        <strong>Tổng cộng</strong>
                        <strong class="text-danger">{{ number_format($total) }} đ</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection