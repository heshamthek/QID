<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyInfoController;
use App\Http\Controllers\DrugCategoryController;
use App\Http\Controllers\DrugWarehouseController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PharmacyInfoFormController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// User routes with role check middleware
Route::prefix('dashboard/user')->name('dashboard.user.')->middleware('checkUserStatus')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('view');
    Route::get('/user/create', [UserController::class, 'create'])->name('create');
    Route::post('/user', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

// Pharmacy routes with role check middleware
Route::prefix('dashboard/pharmacy')->middleware('checkUserStatus')->group(function () {
    Route::get('/', [PharmacyInfoController::class, 'index'])->name('dashboard.pharmacy.index');
    Route::get('/create', [PharmacyInfoController::class, 'create'])->name('dashboard.pharmacy.create');
    Route::post('/', [PharmacyInfoController::class, 'store'])->name('dashboard.pharmacy.store');
    Route::get('/{pharmacyInfo}/edit', [PharmacyInfoController::class, 'edit'])->name('dashboard.pharmacy.edit');
    Route::put('/{pharmacyInfo}', [PharmacyInfoController::class, 'update'])->name('dashboard.pharmacy.update');
    Route::delete('/{pharmacyInfo}', [PharmacyInfoController::class, 'destroy'])->name('dashboard.pharmacy.destroy');
});

// Routes for Pharmacy Info Form
Route::get('/pharmacy/create', [PharmacyInfoFormController::class, 'create'])->name('pharmacy.create');
Route::post('/pharmacy', [PharmacyInfoFormController::class, 'store'])->name('pharmacy.store');

// Drug categories routes with role check middleware
Route::prefix('dashboard')->middleware('checkUserStatus')->group(function () {
    Route::get('drug_categories', [DrugCategoryController::class, 'index'])->name('dashboard.drug_categories.index');
    Route::get('drug_categories/create', [DrugCategoryController::class, 'create'])->name('dashboard.drug_categories.create');
    Route::post('drug_categories', [DrugCategoryController::class, 'store'])->name('dashboard.drug_categories.store');
    Route::get('drug_categories/{drugCategory}/edit', [DrugCategoryController::class, 'edit'])->name('dashboard.drug_categories.edit');
    Route::put('drug_categories/{drugCategory}', [DrugCategoryController::class, 'update'])->name('dashboard.drug_categories.update');
    Route::delete('drug_categories/{drugCategory}', [DrugCategoryController::class, 'destroy'])->name('dashboard.drug_categories.destroy');
});

// Drug warehouses routes with role check middleware
Route::prefix('dashboard')->middleware('checkUserStatus')->group(function () {
    Route::get('drug_warehouses', [DrugWarehouseController::class, 'index'])->name('dashboard.drug_warehouses.index');
    Route::get('drug_warehouses/create', [DrugWarehouseController::class, 'create'])->name('dashboard.drug_warehouses.create');
    Route::post('drug_warehouses', [DrugWarehouseController::class, 'store'])->name('dashboard.drug_warehouses.store');
    Route::get('drug_warehouses/{drugWarehouse}/edit', [DrugWarehouseController::class, 'edit'])->name('dashboard.drug_warehouses.edit');
    Route::put('drug_warehouses/{drugWarehouse}', [DrugWarehouseController::class, 'update'])->name('dashboard.drug_warehouses.update');
    Route::delete('drug_warehouses/{drugWarehouse}', [DrugWarehouseController::class, 'destroy'])->name('dashboard.drug_warehouses.destroy');
});

// Drug routes with role check middleware
Route::prefix('dashboard')->name('dashboard.')->middleware('checkUserStatus')->group(function () {
    Route::get('/drug', [DrugController::class, 'index'])->name('drug.index');
    Route::get('/drug/create', [DrugController::class, 'create'])->name('drug.create');
    Route::post('/drug', [DrugController::class, 'store'])->name('drug.store');
    Route::get('/drug/{drug}', [DrugController::class, 'show'])->name('drug.show');
    Route::get('/drug/{drug}/edit', [DrugController::class, 'edit'])->name('drug.edit');
    Route::put('/drug/{drug}', [DrugController::class, 'update'])->name('drug.update');
    Route::delete('/drug/{drug}', [DrugController::class, 'destroy'])->name('drug.destroy');
});

// Auth routes
Auth::routes();

// Redirect home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Redirect for registration
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

// Landing page route for role 0
Route::get('/landing', function () {
    return view('landing'); // Ensure this view exists in resources/views
})->name('landing');
