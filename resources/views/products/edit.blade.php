<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> تعديل المنتج</title>
</head>
<body>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- استخدم هذا لإخبار Laravel أن هذه هي عملية التحديث -->
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" required>{{ $product->description }}</textarea>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="text" id="price" name="price" value="{{ $product->price }}" required>
        </div>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>