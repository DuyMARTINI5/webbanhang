@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h2 class="fw-bold mb-1">Tất cả sản phẩm</h2>
                    <p class="text-muted mb-0">Khám phá các mẫu giày đang có tại cửa hàng.</p>
                </div>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('products.create') }}" class="btn btn-danger rounded-pill px-4 fw-semibold">
                            + Thêm sản phẩm
                        </a>
                    @endif
                @endauth
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="row g-3">
                <div class="col-lg-5 col-md-5">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control form-control-lg rounded-pill"
                        placeholder="Tìm theo tên sản phẩm..."
                        value="{{ request('keyword') }}"
                    >
                </div>

                <div class="col-lg-4 col-md-4">
                    <select name="category_id" class="form-select form-select-lg rounded-pill">
                        <option value="">-- Tất cả danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3 col-md-3 d-flex gap-2">
                    <button class="btn btn-danger btn-lg rounded-pill w-100 fw-semibold">Tìm kiếm</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill w-100">Làm mới</a>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-1">Danh sách sản phẩm</h4>
            <p class="text-muted mb-0">Có {{ $products->total() }} sản phẩm phù hợp.</p>
        </div>
    </div>

    <div class="row">
        @forelse($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="position-relative">
                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                class="card-img-top"
                                style="height: 240px; object-fit: cover;"
                                alt="{{ $product->name }}"
                            >
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                 style="height: 240px;">
                                <span class="text-muted">Không có ảnh</span>
                            </div>
                        @endif

                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-danger px-3 py-2">Hot</span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <div class="mb-2">
                            <span class="badge bg-light text-dark border">
                                {{ $product->category->name ?? 'Không có danh mục' }}
                            </span>
                        </div>

                        <h5 class="fw-bold mb-2" style="min-height: 48px;">
                            {{ $product->name }}
                        </h5>

                        <p class="text-muted small mb-3" style="min-height: 42px;">
                            {{ \Illuminate\Support\Str::limit($product->description ?? 'Sản phẩm đẹp, dễ phối đồ, phù hợp nhiều nhu cầu sử dụng.', 60) }}
                        </p>

                        <div class="mb-3">
                            <span class="fs-4 fw-bold text-danger">
                                {{ number_format($product->price) }} đ
                            </span>
                        </div>

                        <div class="mt-auto d-grid gap-2">
                            <a href="{{ route('products.show', $product->id) }}"
                               class="btn btn-outline-dark rounded-pill fw-semibold">
                                Xem chi tiết
                            </a>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger rounded-pill fw-bold w-100">
                                    Mua ngay
                                </button>
                            </form>

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-warning rounded-pill w-100 fw-semibold">
                                            Sửa
                                        </a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="btn btn-outline-danger rounded-pill w-100 fw-semibold"
                                                onclick="return confirm('Xóa sản phẩm này?')">
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning rounded-4 shadow-sm mb-0">
                    Không có sản phẩm nào phù hợp.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>

</div>
@endsection