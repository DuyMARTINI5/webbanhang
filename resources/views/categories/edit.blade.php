@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3>Sửa danh mục</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên danh mục</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
                </div>

                <button class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
@endsection