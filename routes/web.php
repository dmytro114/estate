<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MailcontentController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('custom-login', [LoginController::class, 'customLogin'])->name('login.custom'); 
Route::get('register', [LoginController::class, 'registration'])->name('register');
Route::post('custom-registration', [LoginController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [LoginController::class, 'signOut'])->name('signout');

Route::middleware('auth')->group(function () {
    Route::get('home', [AccountController::class, 'index'])->name('account.index');
    Route::post('account-updategeneral/{id}', [AccountController::class, 'updategeneral'])->name('account.updategeneral');
    Route::post('account-updatechangepass/{id}', [AccountController::class, 'updatechangepass'])->name('account.updatechangepass');

    Route::get('category', [CategoriesController::class, 'index'])->name('category.index');
    Route::post('category-create', [CategoriesController::class, 'create'])->name('category.create');
    Route::post('category-update/{id}', [CategoriesController::class, 'update'])->name('category.update');
    Route::post('category-delete/{id}', [CategoriesController::class, 'delete'])->name('category.delete');

    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::post('product-create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product-update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('product-change/{id}', [ProductController::class, 'change'])->name('product.change');
    Route::post('product-delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('itempage/{product}', [ItemController::class, 'index'])->name('item.index');
    Route::post('item-create', [ItemController::class, 'create'])->name('item.create');
    Route::post('item-update/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::post('item-delete/{id}', [ItemController::class, 'delete'])->name('item.delete');

    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('customer-create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('customer-update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::post('customer-delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');

    Route::get('mailcontent', [MailcontentController::class, 'index'])->name('mailcontent.index');
    Route::post('mailcontent-create', [MailcontentController::class, 'create'])->name('mailcontent.create');
    Route::post('mailcontent-update/{id}', [MailcontentController::class, 'update'])->name('mailcontent.update');

});

Route::get('show/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('category/{category}', [CategoriesController::class, 'show'])->name('category.show');
Route::get('application/{product}', [ProductController::class, 'application'])->name('product.application');
Route::get('favourite', [ProductController::class, 'favourite'])->name('product.favourite');
Route::post('favourite/{id}', [ItemController::class, 'favourite'])->name('item.favourite');



//clear cache

Route::get('/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return 'Config cache cleared';
});

Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return 'Config cache cleared';
});


Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});