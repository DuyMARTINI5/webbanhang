@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">

    <div class="rounded-4 overflow-hidden shadow mb-4"
         style="background: linear-gradient(135deg, #111827 0%, #1f2937 45%, #dc2626 100%);">
        <div class="row align-items-center g-0">
            <div class="col-lg-7 p-5 text-white">
                <span class="badge bg-warning text-dark px-3 py-2 mb-3">Mẫu mới • Giá tốt • Dễ phối đồ</span>

                <h1 class="fw-bold display-5 mb-3">
                    Chọn đôi giày hợp gu,
                    <span class="text-warning">mua ngay hôm nay</span>
                </h1>

                <p class="fs-5 text-light mb-4" style="max-width: 650px;">
                    Bộ sưu tập giày thể thao, sneaker và dép thời trang dành cho người thích sự năng động.
                    Giá rõ ràng, hình ảnh trực quan, thao tác đặt hàng nhanh.
                </p>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="#san-pham-noi-bat" class="btn btn-warning btn-lg fw-bold px-4">
                        Mua ngay
                    </a>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-lg px-4">
                        Xem giỏ hàng
                    </a>
                </div>

                <div class="row text-center text-lg-start g-3">
                    <div class="col-4">
                        <div class="bg-white bg-opacity-10 rounded-3 p-3">
                            <div class="fw-bold fs-4">{{ $products->total() }}</div>
                            <div class="small text-light">Sản phẩm</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="bg-white bg-opacity-10 rounded-3 p-3">
                            <div class="fw-bold fs-4">Hot</div>
                            <div class="small text-light">Mẫu bán chạy</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="bg-white bg-opacity-10 rounded-3 p-3">
                            <div class="fw-bold fs-4">Nhanh</div>
                            <div class="small text-light">Đặt hàng dễ</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block">
                <div class="h-100 d-flex align-items-center justify-content-center p-4">
                    <div class="bg-white rounded-4 shadow-lg p-3" style="width: 90%; transform: rotate(-6deg);">
                        @if($products->count() > 0 && $products[0]->image)
                            <img
                                src="{{ asset('storage/' . $products[0]->image) }}"
                                alt="{{ $products[0]->name }}"
                                class="img-fluid rounded-4"
                                style="height: 360px; width: 100%; object-fit: cover;"
                            >
                        @else
                            <div class="rounded-4 bg-light d-flex align-items-center justify-content-center"
                                 style="height: 360px;">
                                <span class="text-muted fs-5">Ảnh sản phẩm nổi bật</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100 border-start border-4 border-danger">
                <div class="fw-bold fs-5 mb-2">Thiết kế nổi bật</div>
                <div class="text-muted">Nhiều mẫu giày dễ phối đồ, hợp đi học, đi chơi và vận động.</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100 border-start border-4 border-warning">
                <div class="fw-bold fs-5 mb-2">Giá rõ ràng</div>
                <div class="text-muted">Hiển thị giá trực tiếp, dễ so sánh và chọn nhanh sản phẩm phù hợp.</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100 border-start border-4 border-success">
                <div class="fw-bold fs-5 mb-2">Mua hàng nhanh</div>
                <div class="text-muted">Xem chi tiết, thêm vào giỏ và đặt hàng chỉ trong vài thao tác.</div>
            </div>
        </div>
    </div>


    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="fw-bold mb-1">Tìm đôi giày bạn muốn</h3>
                    <p class="text-muted mb-0">Lọc nhanh theo tên sản phẩm hoặc danh mục.</p>
                </div>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('products.index') }}" class="btn btn-dark">
                            Quản lý sản phẩm
                        </a>
                    @endif
                @endauth
            </div>

            <form method="GET" action="{{ route('home') }}" class="row g-3">
                <div class="col-md-5">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control form-control-lg"
                        placeholder="Nhập tên giày bạn muốn tìm..."
                        value="{{ request('keyword') }}"
                    >
                </div>

                <div class="col-md-4">
                    <select name="category_id" class="form-select form-select-lg">
                        <option value="">-- Tất cả danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-danger btn-lg w-100">Tìm ngay</button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg w-100">Làm mới</a>
                </div>
            </form>
        </div>
    </div>


    <div class="d-flex justify-content-between align-items-center mb-3" id="san-pham-noi-bat">
        <div>
            <h2 class="fw-bold mb-1">Sản phẩm nổi bật</h2>
            <p class="text-muted mb-0">Chọn nhanh những mẫu đang được quan tâm.</p>
        </div>
        <div class="badge bg-dark fs-6 px-3 py-2">
            {{ $products->total() }} sản phẩm
        </div>
    </div>


    <div class="row">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative"
                     style="transition: 0.3s;">
                    <div class="position-absolute top-0 start-0 m-3" style="z-index: 2;">
                        <span class="badge bg-danger px-3 py-2">Hot</span>
                    </div>

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

                    <div class="card-body d-flex flex-column p-4">
                        <div class="mb-2">
                            <span class="badge bg-light text-dark border">
                                {{ $product->category->name ?? 'Không có danh mục' }}
                            </span>
                        </div>

                        <h5 class="card-title fw-bold mb-2" style="min-height: 48px;">
                            {{ $product->name }}
                        </h5>

                        <p class="text-muted small mb-3" style="min-height: 40px;">
                            {{ \Illuminate\Support\Str::limit($product->description, 55) }}
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
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning rounded-4 shadow-sm mb-0">
                    Không có sản phẩm phù hợp.
                </div>
            </div>
        @endforelse
    </div>

    <div class="bg-dark text-white rounded-4 shadow p-4 p-md-5 mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold mb-2">Đừng bỏ lỡ mẫu giày bạn thích</h3>
                <p class="mb-0 text-light">
                    Chọn sản phẩm ngay hôm nay, thêm vào giỏ và hoàn tất đơn hàng chỉ trong vài bước.
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="#san-pham-noi-bat" class="btn btn-warning btn-lg fw-bold px-4">
                    Chọn mua ngay
                </a>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>
</div>
@endsection