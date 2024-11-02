<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyInfoController;
use App\Http\Controllers\DrugCategoryController;
use App\Http\Controllers\DrugWarehouseController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PharmacyInfoFormController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

// Admin middleware protected routes
Route::middleware(['auth', 'admin.access'])->group(function () {

    
    
    // Dashboard route
    Route::get('/dashboard', [ChartsController::class, 'index'])->name('dashboard');

    // User routes
    Route::prefix('dashboard/user')->name('dashboard.user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('view');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Pharmacy routes
    Route::prefix('dashboard/pharmacy')->name('dashboard.pharmacy.')->group(function () {
        Route::get('/', [PharmacyInfoController::class, 'index'])->name('index');
        Route::get('/create', [PharmacyInfoController::class, 'create'])->name('create');
        Route::post('/', [PharmacyInfoController::class, 'store'])->name('store');
        Route::get('/{pharmacyInfo}/edit', [PharmacyInfoController::class, 'edit'])->name('edit');
        Route::put('/{pharmacyInfo}', [PharmacyInfoController::class, 'update'])->name('update');
        Route::delete('/{pharmacyInfo}', [PharmacyInfoController::class, 'destroy'])->name('destroy');
    });

    // Drug Category routes
    Route::prefix('dashboard/categories')->name('dashboard.drug_categories.')->group(function () {
        Route::get('/', [DrugCategoryController::class, 'index'])->name('index');
        Route::get('/create', [DrugCategoryController::class, 'create'])->name('create');
        Route::post('/', [DrugCategoryController::class, 'store'])->name('store');
        Route::get('/{drugCategory}/edit', [DrugCategoryController::class, 'edit'])->name('edit');
        Route::put('/{drugCategory}', [DrugCategoryController::class, 'update'])->name('update');
        Route::delete('/{drugCategory}', [DrugCategoryController::class, 'destroy'])->name('destroy');
    });

    // Drug Warehouse routes
    Route::prefix('dashboard/warehouses')->name('dashboard.drug_warehouses.')->group(function () {
        Route::get('/', [DrugWarehouseController::class, 'index'])->name('index');
        Route::get('/create', [DrugWarehouseController::class, 'create'])->name('create');
        Route::post('/', [DrugWarehouseController::class, 'store'])->name('store');
        Route::get('/{drugWarehouse}/edit', [DrugWarehouseController::class, 'edit'])->name('edit');
        Route::put('/{drugWarehouse}', [DrugWarehouseController::class, 'update'])->name('update');
        Route::delete('/{drugWarehouse}', [DrugWarehouseController::class, 'destroy'])->name('destroy');
    });

    // Drug routes
    Route::prefix('dashboard/drug')->name('dashboard.drug.')->group(function () {
        Route::get('/', [DrugController::class, 'index'])->name('index');
        Route::get('/create', [DrugController::class, 'create'])->name('create');
        Route::post('/', [DrugController::class, 'store'])->name('store');
        Route::get('/{drug}/edit', [DrugController::class, 'edit'])->name('edit');
        Route::put('/{drug}', [DrugController::class, 'update'])->name('update');
        Route::delete('/{drug}', [DrugController::class, 'destroy'])->name('destroy');
        Route::get('/{drug}/view', [DrugController::class, 'show'])->name('show');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard/orders', [OrderItemController::class, 'index'])->name('dashboard.orders.index');

});


    Route::get('/', function () {
        return view('landing');
    })->name('home');
    

    Route::get('/shop', [ShopController::class, 'index'])->name('websitelayout.Shop');
Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/pharmacy/form', [PharmacyInfoFormController::class, 'create'])->name('pharmacy.create');
    Route::post('/pharmacy/store', [PharmacyInfoFormController::class, 'store'])->name('pharmacy.store');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::patch('/cart/update/{item}', [CartController::class, 'updateCart'])->name('cart.update'); // Make sure this is correct
    Route::post('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
});
