@extends('layouts.app')

@section('content')
<div class="container">
    <h2>إضافة منتج جديد</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">اسم المنتج</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">السعر</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">صورة المنتج</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">إضافة</button>
    </form>
</div>
@endsection