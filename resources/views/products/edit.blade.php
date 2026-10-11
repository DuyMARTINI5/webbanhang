@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    <div class="card-header">
        <h3>Sửa sản phẩm</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="mb-3">

                <label class="form-label">Tên sản phẩm</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $product->name) }}">

                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">Mô tả</label>

                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description', $product->description) }}</textarea>

                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">Giá</label>

                <input type="number"
                       name="price"
                       class="form-control"
                       value="{{ old('price', $product->price) }}">

                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">Danh mục</label>

                <select name="category_id" class="form-select">

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">Ảnh sản phẩm</label>

                <input type="file"
                       name="image"
                       class="form-control">

                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>


            @if($product->image)

                <div class="mb-3">

                    <label class="form-label">Ảnh hiện tại</label>

                    <div>
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            style="width:150px;height:150px;object-fit:cover"
                            class="img-thumbnail">
                    </div>

                </div>

            @endif


            <button class="btn btn-primary">
                Cập nhật
            </button>

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">

                Quay lại

            </a>

        </form>

    </div>

</div>

@endsection