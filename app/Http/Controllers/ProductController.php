<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('company')->get();
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'product_name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'company_id', 'product_name', 'price', 'stock', 'comment'
        ]);

        // 画像がアップロードされた場合
        if ($request->hasFile('img_path')) {
            $path = $request->file('img_path')->store('images', 'public');
            $data['img_path'] = $path;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    public function show(Product $product)
    {
        $product->load('company');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'product_name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'company_id', 'product_name', 'price', 'stock', 'comment'
        ]);

        // 画像がアップロードされた場合
        if ($request->hasFile('img_path')) {
            // 古い画像を削除（任意）
            if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
                Storage::disk('public')->delete($product->img_path);
            }

            $path = $request->file('img_path')->store('images', 'public');
            $data['img_path'] = $path;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }

    public function destroy(Product $product)
    {
        // 画像も削除（任意）
        if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
            Storage::disk('public')->delete($product->img_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}
