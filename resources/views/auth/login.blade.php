@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3>Đăng nhập</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <button class="btn btn-success">Đăng nhập</button>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Đăng ký</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection