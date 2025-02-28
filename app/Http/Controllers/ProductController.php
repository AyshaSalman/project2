<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);

          // إنشاء المنتج
         Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
         ]);

         
        return redirect()->route('products.index')
            ->with('success', 'تمت إضافة المنتج بنجاح!');

        
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
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'تم تحديث المنتج بنجاح!');
    }

    // حذف المنتج
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'تم حذف المنتج بنجاح!');
    }
}