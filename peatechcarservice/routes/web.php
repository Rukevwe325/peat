<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\UserAuth;
use App\Models\Admin;
use App\Http\Controllers\Admin\StoreController;
use App\Models\Store;
use App\Models\Car;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BookController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    // Get all admins except superadmins
    $admins = Admin::select('id', 'first_name', 'last_name')
                   ->where('role', '!=', 'superadmin')
                   ->get();

    return view('home', compact('admins'));
});


Route::get('/autoshops', function () {
    $stores = Store::select('store_address', 'state', 'store_name', 'image_1')->get();
    return view('autoshop', compact('stores'));
})->name('autoshops');
Route::get('/cars-for-sale', function () {
    $cars = Car::select('name', 'price', 'model', 'year', 'description', 'image_1', 'image_2', 'image_3')->get();
    return view('carsforsale', compact('cars'));
})->name('cars.for.sale');
// Route::post('/book-service', [BookingController::class, 'store'])->name('book.store');



// Admin Routes

Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
Route::get('/shops/nearby', [ShopController::class, 'nearby']);
Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');


Route::get('/0xfd', [AuthController::class, 'showLogin'])->name('admin.login');
Route::get('/0xfdregister', [AuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/0xfdsub', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('admin.register.submit');

Route::middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index')->middleware('admin.auth');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings.index');
    Route::get('/store', [StoreController::class, 'index'])->name('admin.store.index');
    Route::get('/cars/create', [CarController::class, 'create'])->name('admin.cars.create');
    Route::post('/cars/store', [CarController::class, 'store'])->name('admin.cars.store');

    Route::post('/settings', [DashboardController::class, 'updateAvailableTime'])->name('admin.settings.update');
     // Store creation page
    Route::get('/store/create', [StoreController::class, 'create'])->name('admin.store.create');
    // Save store
    Route::post('/store/save', [StoreController::class, 'save'])->name('admin.store.save');
    // List stores (optional, for dashboard)
    Route::get('/stores', [StoreController::class, 'index'])->name('admin.store.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
Route::post('/book-appointment/{admin}', [BookController::class, 'store'])->name('book.store');

// User Routes
// use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserAuthController;

Route::get('/userregister', [UserAuthController::class, 'index'])->name('user.register');
Route::post('/regist', [UserAuthController::class, 'register'])->name('user.register.submit');
Route::get('/login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'loginSubmit'])->name('user.login.submit');


Route::get('user/dashboard', function () {
    // Fetch all stores (you can add filters later if needed)
    $stores = Store::all();
    // dd($stores);
    // Pass the stores to the view
    return view('users.dashboard', compact('stores'));
})->name('users.dashboard');

Route::get('user/cars', function () {
    // Fetch all cars
    $cars = Car::select('name', 'price', 'model', 'year', 'description', 'image_1', 'image_2', 'image_3', 'admin_id', 'id')->get();

    return view('users.cars', compact('cars'));
})->name('users.cars');
// web.php
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
Route::get('/book/cars', [CarController::class, 'book'])->name('book.cars');
Route::get('/cars/{car}', function (Car $car) {
    return view('users.showcars', compact('car'));
})->name('cars.show');

use App\Http\Controllers\CarPurchaseController;

Route::middleware('auth')->group(function () {
    Route::get('/cars/{car}/purchase', [CarPurchaseController::class, 'initiate'])
        ->name('cars.purchase');

    Route::get('/payment/callback', [CarPurchaseController::class, 'callback'])
        ->name('payment.callback');
});

Route::view('/payment/success', 'payments.success')->name('payment.success');
Route::view('/payment/failed', 'payments.failed')->name('payment.failed');




