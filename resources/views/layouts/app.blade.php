<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web bán hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Web bán hàng</a>

            <div class="d-flex gap-2 align-items-center flex-wrap">
    <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">Trang chủ</a>
    <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm">Sản phẩm</a>

    <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm">
        Giỏ hàng ({{ array_sum(array_column(session('cart', []), 'quantity')) }})
    </a>

    @auth
        <span class="text-white small">
            Xin chào, {{ auth()->user()->name }}
            @if(auth()->user()->isAdmin())
                <span class="badge bg-warning text-dark">Admin</span>
            @else
                <span class="badge bg-info text-dark">User</span>
            @endif
        </span>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('categories.index') }}" class="btn btn-outline-warning btn-sm">Danh mục</a>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-warning btn-sm">Đơn hàng</a>
            <a href="{{ route('products.create') }}" class="btn btn-outline-warning btn-sm">Thêm SP</a>
        @endif

        <form action="{{ route('logout') }}" method="POST" style="display:inline-block;">
            @csrf
            <button class="btn btn-danger btn-sm">Đăng xuất</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="btn btn-success btn-sm">Đăng nhập</a>
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Đăng ký</a>
    @endauth
</div>
        </div>
    </nav>

    <div class="container pb-4">
        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>