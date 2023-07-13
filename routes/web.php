<?php

use App\Http\Controllers\ProfileController;
use App\Models\Banners;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;

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
$product=Product::get()->toArray();
$client=Client::get()->toArray();
    return view('dashboard')->with(compact('product','client'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

Route::namespace('Auth')->middleware('guest:admin')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('adminlogin');
  //  Route::get('login','AuthenticatedSessionController@create')->name('login');
    // Controllers Within The 'App\Http\Controllers\Admin' Namespace
});


Route::middleware('admin')->group(function(){
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('user', [HomeController::class, 'getuser'])->name('user');
    Route::get('edit/{id}', [HomeController::class, 'edit'])->name('edit'); // Add this line
    Route::post('store',[HomeController::class, 'addstore'])->name('store');
    //Route::delete('delete/{id}', [HomeController::class, 'delete'])->name('delete');
   // Route::get('destroy/{id}', [HomeController::class, 'destroy'])->name('destroy');
   Route::get('destroy/{id}', [HomeController::class, 'destroy'])->name('destroy');
Route::post('banneradd',[ProductController::class,'banneradd'])->name('banneradd');
Route::get('banneredit/{id}',[ProductController::class,'banneredit'])->name('banneredit');
Route::get('bannerdelete/{id}',[ProductController::class,'bannerdelete'])->name('bannerdelete');
Route::post('productadd',[ProductController::class,'productadd'])->name('productadd');
Route::get('productedit/{id}',[ProductController::class,'productedit'])->name('productedit');
Route::get('productdelete/{id}',[ProductController::class,'productdelete'])->name('productdelete');
Route::post('clientadd',[ProductController::class,'clientadd'])->name('clientadd');
Route::get('clientedit/{id}',[ProductController::class,'clientedit'])->name('clientedit');
Route::get('clientdelete/{id}',[ProductController::class,'clientdelete'])->name('clientdelete');

   Route::get('banner',[ProductController::class,'banner'])->name('banner');

   Route::get('product',[ProductController::class,'product'])->name('product');

   Route::get('client',[ProductController::class,'client'])->name('client');



});

Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Controllers Within The 'App\Http\Controllers\Admin' Namespace
});