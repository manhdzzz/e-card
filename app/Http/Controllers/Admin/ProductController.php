<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', ['product' => null]);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'price' => 'required']);
        $data = $request->only('title','price','short_desc','full_desc','sort_order','is_active');
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::url($request->file('image')->store('public/products'));
        }
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Thêm giải pháp thành công!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate(['title' => 'required', 'price' => 'required']);
        $data = $request->only('title','price','short_desc','full_desc','sort_order');
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::url($request->file('image')->store('public/products'));
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa giải pháp!');
    }
}
