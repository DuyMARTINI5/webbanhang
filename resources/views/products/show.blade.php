@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-5">
                @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        class="img-fluid rounded border"
                        alt="{{ $product->name }}"
                    >
                @else
                    <div class="border rounded p-5 text-center bg-light">
                        Không có ảnh
                    </div>
                @endif
            </div>

            <div class="col-md-7">
                <p class="text-muted mb-2">
                    {{ $product->category->name ?? 'Không có danh mục' }}
                </p>

                <h2 class="fw-bold">
                    {{ $product->name }}
                </h2>

                <h3 class="text-danger mb-3">
                    {{ number_format($product->price) }} đ
                </h3>

                <p>{{ $product->description }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-3">
                    @csrf
                    <button class="btn btn-success">Thêm vào giỏ hàng</button>
                </form>

                <a href="{{ route('home') }}" class="btn btn-secondary">Quay lại</a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                            Sửa
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection