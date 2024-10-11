<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyInfoController;
use App\Http\Controllers\DrugCategoryController;
use App\Http\Controllers\DrugWarehouseController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PharmacyInfoFormController;

Route::get('/', function () {
    return view('welcome');
});

// User routes
Route::prefix('dashboard/user')->name('dashboard.user.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('view');
    Route::get('/user/create', [UserController::class, 'create'])->name('create');
    Route::post('/user', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

// Pharmacy routes
Route::prefix('dashboard/pharmacy')->group(function () {
    Route::get('/', [PharmacyInfoController::class, 'index'])->name('dashboard.pharmacy.index');
    Route::get('/create', [PharmacyInfoController::class, 'create'])->name('dashboard.pharmacy.create');
    Route::post('/', [PharmacyInfoController::class, 'store'])->name('dashboard.pharmacy.store');
    Route::get('/{pharmacyInfo}/edit', [PharmacyInfoController::class, 'edit'])->name('dashboard.pharmacy.edit');
    Route::put('/{pharmacyInfo}', [PharmacyInfoController::class, 'update'])->name('dashboard.pharmacy.update');
    Route::delete('/{pharmacyInfo}', [PharmacyInfoController::class, 'destroy'])->name('dashboard.pharmacy.destroy');
});

// Pharmacy Info Form routes
Route::middleware(['auth'])->group(function () {
    // Route to show the form to create pharmacy information
    Route::get('/formforpharmacy/form', [PharmacyInfoFormController::class, 'create'])->name('pharmacy.create');

    // Route to store the pharmacy information
    Route::post('/formforpharmacy/store', [PharmacyInfoFormController::class, 'store'])->name('pharmacy.store');
});

// Drug Category routes
Route::prefix('dashboard')->group(function () {
    Route::get('drug_categories', [DrugCategoryController::class, 'index'])->name('dashboard.drug_categories.index');
    Route::get('drug_categories/create', [DrugCategoryController::class, 'create'])->name('dashboard.drug_categories.create');
    Route::post('drug_categories', [DrugCategoryController::class, 'store'])->name('dashboard.drug_categories.store');
    Route::get('drug_categories/{drugCategory}/edit', [DrugCategoryController::class, 'edit'])->name('dashboard.drug_categories.edit');
    Route::put('drug_categories/{drugCategory}', [DrugCategoryController::class, 'update'])->name('dashboard.drug_categories.update');
    Route::delete('drug_categories/{drugCategory}', [DrugCategoryController::class, 'destroy'])->name('dashboard.drug_categories.destroy');
});

// Drug Warehouse routes
Route::prefix('dashboard')->group(function () {
    Route::get('drug_warehouses', [DrugWarehouseController::class, 'index'])->name('dashboard.drug_warehouses.index');
    Route::get('drug_warehouses/create', [DrugWarehouseController::class, 'create'])->name('dashboard.drug_warehouses.create');
    Route::post('drug_warehouses', [DrugWarehouseController::class, 'store'])->name('dashboard.drug_warehouses.store');
    Route::get('drug_warehouses/{drugWarehouse}/edit', [DrugWarehouseController::class, 'edit'])->name('dashboard.drug_warehouses.edit');
    Route::put('drug_warehouses/{drugWarehouse}', [DrugWarehouseController::class, 'update'])->name('dashboard.drug_warehouses.update');
    Route::delete('drug_warehouses/{drugWarehouse}', [DrugWarehouseController::class, 'destroy'])->name('dashboard.drug_warehouses.destroy');
});

// Drug routes
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/drug', [DrugController::class, 'index'])->name('drug.index');
    Route::get('/drug/create', [DrugController::class, 'create'])->name('drug.create');
    Route::post('/drug', [DrugController::class, 'store'])->name('drug.store');
    Route::get('/drug/{drug}/edit', [DrugController::class, 'edit'])->name('drug.edit');
    Route::put('/drug/{drug}', [DrugController::class, 'update'])->name('drug.update');
    Route::delete('/drug/{drug}', [DrugController::class, 'destroy'])->name('drug.destroy');
});

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authentication routes
Auth::routes();


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
