<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// 🔽 CompanyController のルートは個別指定していなければ resource のままでOK
Route::resource('companies', CompanyController::class);

// 🔽 ProductController のルートは個別に指定
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
