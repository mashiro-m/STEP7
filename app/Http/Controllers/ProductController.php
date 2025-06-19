<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('company');
    
        // 商品名で部分一致検索
        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }
    
        // メーカーで絞り込み
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }
    
        $products = $query->get();
        $companies = Company::all();
    
        return view('products.index', compact('products', 'companies'));
    }
    

    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    public function store(ProductRequest $request)
    {
        
        try {
            $data = $request->only([
                'company_id', 'product_name', 'price', 'stock', 'comment'
            ]);
    
            if ($request->hasFile('img_path')) {
                $path = $request->file('img_path')->store('images', 'public');
                $data['img_path'] = $path;
            }
    
            Product::create($data);
    
            return redirect()->route('products.index')->with('success', '商品を登録しました');
        } catch (\Exception $e) {
            return back()->with('error', '商品登録に失敗しました：' . $e->getMessage());
        }
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

    public function update(ProductRequest $request, Product $product)
    {
       
    
        try {
            $data = $request->only([
                'company_id', 'product_name', 'price', 'stock', 'comment'
            ]);
    
            if ($request->hasFile('img_path')) {
                if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
                    Storage::disk('public')->delete($product->img_path);
                }
    
                $path = $request->file('img_path')->store('images', 'public');
                $data['img_path'] = $path;
            }
    
            $product->update($data);
    
            return redirect()->route('products.index')->with('success', '商品を更新しました');
        } catch (\Exception $e) {
            return back()->with('error', '商品更新に失敗しました：' . $e->getMessage());
        }
    }
    
    public function destroy(Product $product)
{
    try {
        if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
            Storage::disk('public')->delete($product->img_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    } catch (\Exception $e) {
        return back()->with('error', '商品削除に失敗しました：' . $e->getMessage());
    }
}

}

