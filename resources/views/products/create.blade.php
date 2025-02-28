<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج جديد</title>
</head>
<body>
    <h1>إضافة منتج جديد</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label>اسم المنتج:</label>
        <input type="text" name="name" required>
        <label>الوصف:</label>
        <textarea name="description"></textarea>
        <label>السعر:</label>
        <input type="number" name="price" step="0.01" required>
        <button type="submit">إضافة</button>
    </form>
</body>
</html>