<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\CustomerTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/get-products/{category}', [DashboardController::class, 'getProducts']);
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::prefix('category')->group(function () {
        Route::get('add', [CategoryController::class, 'addPage'])->name('category.add');
        Route::post('add', [CategoryController::class, 'store'])->name('category.store');
        Route::get('list', [CategoryController::class, 'list'])->name('category.list');
        Route::post('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    Route::prefix('supplier')->group(function () {
        Route::get('add', [SupplierController::class, 'add'])->name('supplier.add');
        Route::post('add', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('list', [SupplierController::class, 'list'])->name('supllier.list');
    });

    Route::prefix('supplier-transaction')->group(function () {
        Route::get('add/{id}', [TransactionController::class, 'add'])->name('transaction.add');
        Route::post('add', [TransactionController::class, 'store'])->name('transaction.store');
        Route::get('send_money/{id}', [TransactionController::class, 'sendMoney'])->name('transaction.send');
        Route::post('send_money', [TransactionController::class, 'store'])->name('transaction.sendMoney');
        Route::get('list/{id}', [TransactionController::class, 'details'])->name('transaction.details');
    });
    Route::prefix('customer-transaction')->group(function () {
        Route::get('add/{id}', [CustomerTransactionController::class, 'add'])->name('transaction.customer.add');
        Route::post('add', [CustomerTransactionController::class, 'store'])->name('transaction.customer.store');
        Route::get('send_money/{id}', [CustomerTransactionController::class, 'sendMoney'])->name('transaction.customer.send');
        Route::post('send_money', [CustomerTransactionController::class, 'store'])->name('transaction.customer.sendMoney');
        Route::get('list/{id}', [CustomerTransactionController::class, 'details'])->name('transaction.customer.details');
    });

    Route::prefix('product')->group(function () {
        Route::get('add', [ProductController::class, 'add'])->name('product.add');
        Route::post('add', [ProductController::class, 'store'])->name('product.store');
        Route::get('list', [ProductController::class, 'list'])->name('product.list');
        Route::get('sale/{id}', [ProductController::class, 'salePage'])->name('product.salePage');
        Route::post('sale', [ProductController::class, 'sale'])->name('product.sale');
    });

    Route::prefix('customer')->group(function () {
        Route::get('add', [CustomerController::class, 'add'])->name('customer.add');
        Route::post('add', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('list', [CustomerController::class, 'list'])->name('customer.list');
    });

    Route::prefix('expense')->group(function () {
        Route::get('list', [ExpenseController::class, 'list'])->name('expense.list');
        Route::get('byDate', [ExpenseController::class, 'byDate'])->name('expense.byDate');
        Route::get('add', [ExpenseController::class, 'add'])->name('expense.add');
        Route::post('add', [ExpenseController::class, 'store'])->name('expense.store');
    });
});
