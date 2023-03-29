<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('products',[ProductController::class,'index'])->name('products.index');
    // Route::get('products/create',[ProductController::class,'create'])->name('products.create');
    // Route::get('products/show',[ProductController::class,'show'])->name('products.show');
    // Route::get('products/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
    // Route::post('products',[ProductController::class,'store'])->name('products.store');
    // Route::put('products/{id}',[ProductController::class,'update'])->name('products.update');
    // Route::delete('/products',[ProductController::class,'destroy'])->name('products.destroy');
    Route::resource('products',ProductController::class);
});

require __DIR__.'/auth.php';
