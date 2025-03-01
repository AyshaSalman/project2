<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // عرض جميع المنتجات
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // عرض نموذج إنشاء منتج جديد
    public function create()
    {
        return view('products.create');
    }

    // تخزين المنتج في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath, // تأكد من إضافة مسار الصورة
        ]);

        return redirect()->route('products.index')->with('success', 'تمت إضافة المنتج بنجاح!');
    }

    // عرض تفاصيل منتج معين
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // عرض نموذج تعديل المنتج
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // تحديث بيانات المنتج
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $product->image; // الاحتفاظ بالصورة القديمة في حال لم يتم تغييرها
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // تخزين الصورة الجديدة
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // تحديث بيانات المنتج
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath, // تحديث مسار الصورة
        ]);

        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح!');
    }

    // حذف المنتج
    public function destroy(Product $product)
    {
        // حذف الصورة من التخزين إذا كانت موجودة
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // حذف المنتج من قاعدة البيانات
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'تم حذف المنتج بنجاح!');
    }
}