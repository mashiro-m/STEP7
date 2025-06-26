<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/companies/create', [ProductController::class, 'companyCreate'])->name('companies.create');
//会社の方
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

//商品の方
Route::get('/companies', [ProductController::class, 'companyIndex'])->name('companies.index');
Route::get('/companies/create', [ProductController::class, 'companyCreate'])->name('companies.create');
Route::post('/companies', [ProductController::class, 'companyStore'])->name('companies.store');
Route::get('/companies/{company}', [ProductController::class, 'companyShow'])->name('companies.show');
Route::get('/companies/{company}/edit', [ProductController::class, 'companyEdit'])->name('companies.edit');
Route::put('/companies/{company}', [ProductController::class, 'companyUpdate'])->name('companies.update');
Route::delete('/companies/{company}', [ProductController::class, 'companyDestroy'])->name('companies.destroy');