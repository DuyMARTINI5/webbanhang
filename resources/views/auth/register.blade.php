@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3>Đăng ký</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nhập lại mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button class="btn btn-primary">Đăng ký</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Đăng nhập</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection